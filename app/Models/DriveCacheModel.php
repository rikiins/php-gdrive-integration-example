<?php

namespace App\Models;

use CodeIgniter\Model;

class DriveCacheModel extends Model
{
    protected $table            = 'drive_cache';
    protected $primaryKey       = 'file_id';
    protected $useAutoIncrement = false;
    protected $protectFields    = false;

    protected $useTimestamps = false;

    public function get(string $file_id = '') : array
    {
        if (empty($file_id)) {
            return $this->limit(20)->findAll() ?? [];
        }

        return $this->where('file_id', $file_id)->first() ?? [];
    }

    public function saveMetadata(array $metadata) : bool
    {
        try {
            $this->insert($metadata);
        } catch (\Exception $e) {
            log_message('error', 'DriveCacheModel.saveMetadata : ' . $e->getMessage());

            return false;
        }

        return true;
    }

    public function deleteMetadata(string $file_id) : bool
    {
        try {
            $this->where('file_id', $file_id)->delete();
        } catch (\Exception $e) {
            log_message('error', 'DriveCacheModel.deleteMetadata : ' . $e->getMessage());

            return false;
        }

        return true;
    }
}
