<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMaterial extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'file_path',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /** Full public URL to the file. */
    public function getFileUrlAttribute(): string
    {
        if (str_starts_with($this->file_path, 'http')) {
            return $this->file_path;
        }
        return asset('storage/' . $this->file_path);
    }

    /** Lowercase file extension (pdf, docx, …). */
    public function getFileExtensionAttribute(): string
    {
        return strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));
    }

    /** PDFs and common images can be rendered inline in the browser. */
    public function getIsPreviewableAttribute(): bool
    {
        return in_array($this->file_extension, ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp']);
    }

    /** Bootstrap-icons class for the file type. */
    public function getFileIconAttribute(): string
    {
        return match ($this->file_extension) {
            'pdf'                    => 'bi-file-pdf-fill',
            'doc', 'docx'            => 'bi-file-word-fill',
            'xls', 'xlsx'            => 'bi-file-excel-fill',
            'ppt', 'pptx'            => 'bi-file-ppt-fill',
            'jpg', 'jpeg',
            'png', 'gif', 'webp'     => 'bi-file-image-fill',
            'mp4', 'mov', 'avi'      => 'bi-file-play-fill',
            'zip', 'rar'             => 'bi-file-zip-fill',
            default                  => 'bi-file-earmark-fill',
        };
    }

    /** Accent colour matching the file type. */
    public function getFileColorAttribute(): string
    {
        return match ($this->file_extension) {
            'pdf'                => '#dc3545',
            'doc', 'docx'        => '#0d6efd',
            'xls', 'xlsx'        => '#198754',
            'ppt', 'pptx'        => '#fd7e14',
            'jpg', 'jpeg',
            'png', 'gif', 'webp' => '#6f42c1',
            'zip', 'rar'         => '#6c757d',
            default              => '#495057',
        };
    }

    /** Human-readable label for the file type. */
    public function getFileLabelAttribute(): string
    {
        return match ($this->file_extension) {
            'pdf'                => 'PDF',
            'doc'                => 'Word',
            'docx'               => 'Word',
            'xls', 'xlsx'        => 'Excel',
            'ppt', 'pptx'        => 'PowerPoint',
            'jpg', 'jpeg',
            'png', 'gif', 'webp' => 'Image',
            'mp4', 'mov', 'avi'  => 'Video',
            'zip', 'rar'         => 'Archive',
            default              => strtoupper($this->file_extension) ?: 'File',
        };
    }
}
