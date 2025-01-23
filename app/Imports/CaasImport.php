<?php
// app/Imports/CaasImport.php

namespace App\Imports;

use App\Models\Caas;
use App\Models\User;
use App\Models\Profile;
use App\Models\Role;
use App\Models\CaasStage;
use App\Models\Stage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CaasImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Find or create user
        $user = User::firstOrCreate(
            ['nim' => $row['nim']], // Match using NIM
            [
                'password' => bcrypt($row['nim']), // Set nim as default password
            ]
        );

        // Create profile
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $row['name'],
                'major' => $row['major'],
                'class' => $row['class'],
                'email' => $row['email'],
            ]
        );

        // Find or create role
        $role = Role::firstOrCreate(['name' => $row['gems']]);

        // Find or create stage
        $stage = Stage::firstOrCreate(['name' => $row['state']]);

        // Create or update CaasStage
        $caasStage = CaasStage::updateOrCreate(
            ['user_id' => $user->id],
            ['stage_id' => $stage->id, 'status' => $row['status']]
        );

        // Create or update Caas
        return Caas::updateOrCreate(
            ['user_id' => $user->id],
            ['role_id' => $role->id]
        );
    }
}
