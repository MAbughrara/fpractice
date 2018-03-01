<?php
/**
 * Created by PhpStorm.
 * User: mohammed.abughrara
 * Date: 2/27/2018
 * Time: 8:37 PM
 */

namespace App;


trait recordsActivity
{

    protected static function bootRecordsActivity()
    {
        if(auth()->guest()) return;

        foreach ( self::getActivityToRecord() as $event)
        {
            static::$event(function ($model) use ($event){
                $model->recordActivity($event);
            });
        }

        static::deleted(function($model){
            $model->activity()->delete();
        });

    }

    protected static function getActivityToRecord()
    {
        return ['created'];
    }

    protected function recordActivity($event)
    {
        $this->activity()->create(
            [
                'user_id' => auth()->id(),
                'type' => $this->getActivityType($event),
            ]
        );
    }

    public function activity()
    {
        return $this->morphMany(Activity::class,'subject');
    }

    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }
}