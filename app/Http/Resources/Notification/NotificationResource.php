<?php

namespace App\Http\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'notification',
                'notification_id' => $this->id,
                'attributes' => [
                    'type' => $this->type,
                    'data' => $this->data,
                    'created_at' => $this->created_at->diffForHumans(),
                    'read_at' => optional($this->read_at)->diffForHumans(),
                ],
            ],
            'links' => [
                'self' => url('/admin/notifications/' . $this->id),
            ],
        ];
    }
}
