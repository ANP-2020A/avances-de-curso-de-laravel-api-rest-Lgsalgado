<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    protected $token;

    /**
     * Transform the resource into an array.
     *
     * @param $resource
     * @param null $token
     */
    public function __construct($resource,$token=null)
    {
        parent::__construct($resource);
        $this->token = $token;

    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            $this->merge($this->userable),
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'token'=>$this->when($this->token,$this->token),
        ];}



}
