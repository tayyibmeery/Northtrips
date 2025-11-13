<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'type',
        'admin_notes',
        'responded_at',
        'assigned_to',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    // Status constants
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_RESOLVED = 'resolved';
    const STATUS_CLOSED = 'closed';

    // Type constants
    const TYPE_GENERAL = 'general';
    const TYPE_BOOKING = 'booking';
    const TYPE_COMPLAINT = 'complaint';
    const TYPE_SUGGESTION = 'suggestion';
    const TYPE_PARTNERSHIP = 'partnership';

    /**
     * Get status options
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_RESOLVED => 'Resolved',
            self::STATUS_CLOSED => 'Closed',
        ];
    }

    /**
     * Get type options
     */
    public static function getTypeOptions()
    {
        return [
            self::TYPE_GENERAL => 'General Inquiry',
            self::TYPE_BOOKING => 'Booking Related',
            self::TYPE_COMPLAINT => 'Complaint',
            self::TYPE_SUGGESTION => 'Suggestion',
            self::TYPE_PARTNERSHIP => 'Partnership',
        ];
    }

    /**
     * Scope for new queries
     */
    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }

    /**
     * Scope for resolved queries
     */
    public function scopeResolved($query)
    {
        return $query->where('status', self::STATUS_RESOLVED);
    }

    /**
     * Scope by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Check if query is new
     */
    public function isNew()
    {
        return $this->status === self::STATUS_NEW;
    }

    /**
     * Check if query is resolved
     */
    public function isResolved()
    {
        return $this->status === self::STATUS_RESOLVED;
    }

    /**
     * Mark as responded
     */
    public function markAsResponded()
    {
        $this->update([
            'status' => self::STATUS_RESOLVED,
            'responded_at' => now(),
        ]);
    }

    /**
     * Get assigned admin user
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get short message preview
     */
    public function getMessagePreviewAttribute()
    {
        return str_limit($this->message, 100);
    }

    /**
     * Get formatted created at
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M j, Y g:i A');
    }
}
