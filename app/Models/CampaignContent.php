<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignContent extends Model
{
    protected $fillable = ['campaign_id', 'type', 'title', 'content', 'order'];
}