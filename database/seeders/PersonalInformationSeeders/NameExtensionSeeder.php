<?php

namespace Database\Seeders\PersonalInformationSeeders;

use App\Models\PersonalInformation\NameExtension;
use App\Models\PersonalInformation\PersonalInformation;
use Illuminate\Database\Seeder;

class NameExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name_ext = new NameExtension();
        $name_ext->title = 'None';
        $name_ext->save();

        $name_ext = new NameExtension();
        $name_ext->title = 'Sr.';
        $name_ext->save();

        $name_ext = new NameExtension();
        $name_ext->title = 'Jr.';
        $name_ext->save();

        $name_ext = new NameExtension();
        $name_ext->title = 'I';
        $name_ext->save();

        $name_ext = new NameExtension();
        $name_ext->title = 'II';
        $name_ext->save();

        $name_ext = new NameExtension();
        $name_ext->title = 'III';
        $name_ext->save();

        $name_ext = new NameExtension();
        $name_ext->title = 'IV';
        $name_ext->save();

        $name_ext = new NameExtension();
        $name_ext->title = 'V';
        $name_ext->save();

        $count = PersonalInformation::all()->count();

        for ($i = 1; $i < $count+1; $i++) {
            $psn_info = PersonalInformation::find($i);
            $psn_info->name_extension_id = 1;
            $psn_info->save();

        }
    }
}
