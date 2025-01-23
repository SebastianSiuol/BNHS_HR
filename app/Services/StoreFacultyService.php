<?php

namespace App\Services;

use App\Models\Faculty;
use App\Models\PersonalInformation\ContactPerson;
use App\Models\PersonalInformation\PermanentAddress;
use App\Models\PersonalInformation\PersonalInformation;
use App\Models\PersonalInformation\ResidentialAddress;

class StoreFacultyService{

    public function storePersonalInformation (Faculty $faculty, array $validated_inputs) {

        $psn_info = new PersonalInformation([
            'first_name'        => $validated_inputs['first_name'],
            'middle_name'       => $validated_inputs['middle_name'],
            'last_name'         => $validated_inputs['last_name'],
            'sex'               => $validated_inputs['sex'],
            'place_of_birth'    => $validated_inputs['place_of_birth'],
            'date_of_birth'     => $validated_inputs['date_of_birth'],
            'telephone_no'      => $validated_inputs['telephone_number'],
            'contact_no'        => $validated_inputs['contact_number'],
            'name_extension_id' => $validated_inputs['name_extension_id'],
            'civil_status_id'   => $validated_inputs['civil_status_id'],
        ]);

        $faculty->personal_information()->save($psn_info);

        return $psn_info;
    }

    public function storeAddresses(PersonalInformation $personal_information, array $validated_inputs)
{
    // Check if the residential and permanent addresses are the same
    $resi_addr = new ResidentialAddress([
        'house_block_no'        => $validated_inputs['residential_houseNumber'],
        'street'                => $validated_inputs['residential_street'],
        'subdivision_village'   => $validated_inputs['residential_subdivision'],
        'barangay'              => $validated_inputs['residential_barangayName'],
        'city_municipality'     => $validated_inputs['residential_cityName'],
        'province'              => $validated_inputs['residential_provinceName'],
        'zip_code'              => $validated_inputs['residential_zipCode'],
    ]);

    if ($validated_inputs['sameAddress']) {
        // Use the residential input values for the permanent address
        $perma_addr = new PermanentAddress([
            'house_block_no'        => $validated_inputs['residential_houseNumber'],
            'street'                => $validated_inputs['residential_street'],
            'subdivision_village'   => $validated_inputs['residential_subdivision'],
            'barangay'              => $validated_inputs['residential_barangayName'],
            'city_municipality'     => $validated_inputs['residential_cityName'],
            'province'              => $validated_inputs['residential_provinceName'],
            'zip_code'              => $validated_inputs['residential_zipCode'],
        ]);
    } else {
        // Use the permanent input values
        $perma_addr = new PermanentAddress([
            'house_block_no'        => $validated_inputs['permanent_houseNumber'],
            'street'                => $validated_inputs['permanent_street'],
            'subdivision_village'   => $validated_inputs['permanent_subdivision'],
            'barangay'              => $validated_inputs['permanent_barangayName'],
            'city_municipality'     => $validated_inputs['permanent_cityName'],
            'province'              => $validated_inputs['permanent_provinceName'],
            'zip_code'              => $validated_inputs['permanent_zipCode'],
        ]);
    }

    // Save the addresses
    $personal_information->residential_address()->save($resi_addr);
    $personal_information->permanent_address()->save($perma_addr);
}


    public function storeContactPerson (PersonalInformation $personal_information, array $validated_inputs) {

        $cont_psn = new ContactPerson([
            'name'              => $validated_inputs['contact_person_name'],
            'contact_no'        => $validated_inputs['contact_person_number'],
        ]);

        $personal_information->contact_person()->save($cont_psn);
    }

}
