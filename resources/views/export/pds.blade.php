<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Personal Data Sheet</title>
</head>

<body>
  <table>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td colspan="14"></td>
    </tr>
    <tr>
      <td colspan="14">PERSONAL DATA SHEET</td>
    </tr>
    <tr>
      <td colspan="14">
        <p>WARNING: Any misrepresentation made in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administrative/criminal case/s against the person concerned.</p>
      </td>
    </tr>
    <tr>
      <td colspan="14">READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM.</td>
    </tr>
    <tr>
    </tr>
    <tr>
      <td colspan="10">
        <p>Print legibly. Tick appropriate boxes ( ☐ ) and use separate sheet if necessary. Indicate N/A if not applicable. <strong>DO NOT ABBREVIATE.</strong></p>
      </td>
      <td colspan="1">
        <p>1. CS ID No.</p>
      </td>
      <td colspan="3">
        <p>(Do not fill up. For CSC use only)</p>
      </td>
    </tr>
    <tr></tr>
    <tr>
      <td colspan="14">I. PERSONAL INFORMATION</td>
    </tr>
    <tr>
      <td colspan="1">2.</td>
      <td colspan="2">SURNAME</td>
      <td colspan="11">{{ strtoupper($faculty->personal_information->last_name) }}</td>
    </tr>
    <tr>
      <td colspan="1"></td>
      <td colspan="2">FIRST NAME</td>
      <td colspan="8">{{ strtoupper($faculty->personal_information->first_name) }}</td>
      <td colspan="3">NAME EXTENSION (JR., SR)</td>
    </tr>
    <tr>
      <td colspan="1"></td>
      <td colspan="2">SURNAME</td>
      <td colspan="11">{{ strtoupper($faculty->personal_information->middle_name) }}</td>
    </tr>
    <tr>
      <td colspan="1">3.</td>
      <td colspan="2"></td>
      <td colspan="3"></td>
      <td colspan="3">16. CITIZENSHIP</td>
      <td colspan="5">☐ Filipino ☐ Dual Citizenship</td>
    </tr>
    <tr></tr>
    <tr>
      <td colspan="1">4.</td>
      <td colspan="2">PLACE OF BIRTH</td>
      <td colspan="3">{{ strtoupper($faculty->personal_information->place_of_birth) }}</td>
      <td colspan="3">If holder of dual citizenship, </td>
    </tr>

    <tr> {{-- Row 16 --}}
      <td colspan="1">5.</td>
      <td colspan="2">SEX</td>
      <td colspan="3">{{strtoupper( $faculty->personal_information->sex) }}</td>
      <td colspan="3">please indicate the details.</td>
    </tr>

    <tr> {{-- Row 17 --}}
      <td colspan="1" rowspan="5">6.</td>
      <td colspan="2" rowspan="5">CIVIL STATUS</td>
      <td colspan="3" rowspan="5">{{ strtoupper($faculty->personal_information->civil_status->civil_status) }}</td>
      <td colspan="2" rowspan="7">17. RESIDENTIAL ADDRESS</td>
      <td colspan="3">{{ strtoupper($faculty->personal_information->residential_address->house_block_no) }}</td>
      <td colspan="3">{{ strtoupper($faculty->personal_information->residential_address->street) }}</td>
    </tr>

    <tr>{{-- Row 18 --}}
      <td colspan="3">House/Block/Lot No.</td>
      <td colspan="3">Street</td>
    </tr>

    <tr></tr> {{-- Row 19 --}}

    <tr>{{-- Row 20 --}}
      <td colspan="3">{{ strtoupper($faculty->personal_information->residential_address->subdivision_village) }}</td>
      <td colspan="3">{{ strtoupper($faculty->personal_information->residential_address->barangay) }}</td>
    </tr>

    <tr>  {{-- Row 21 --}}
      <td colspan="3">Subdivision/Village</td>
      <td colspan="3">Barangay</td>
    </tr>

    <tr> {{-- Row 22 --}}
      <td colspan="1" rowspan="2">7.</td>
      <td colspan="2" rowspan="2">HEIGHT (m)</td>
      <td colspan="3" rowspan="2"></td>
      <td colspan="3">{{ strtoupper($faculty->personal_information->residential_address->city_municipality) }}</td>
      <td colspan="3">{{ strtoupper($faculty->personal_information->residential_address->province) }}</td>
    </tr>

    <tr>  {{-- Row 23 --}}
      <td colspan="3">City/Municipality</td>
      <td colspan="3">Province</td>
    </tr>

    <tr> {{-- Row 24 --}}
      <td colspan="1">8.</td>
      <td colspan="2">WEIGHT (kg)</td>
      <td colspan="3"></td>
      <td colspan="2">ZIP CODE</td>
      <td colspan="6">{{ strtoupper($faculty->personal_information->residential_address->zip_code) }}</td>
    </tr>

    <tr> {{-- Row 25 --}}
      <td colspan="1" rowspan="2">9.</td>
      <td colspan="2" rowspan="2">BLOOD TYPE</td>
      <td colspan="3" rowspan="2"></td>
      <td colspan="2" rowspan="6">18. PERMANENT ADDRESS</td>
    </tr>

    <tr>{{-- Row 26 --}}
      <td colspan="3">House/Block/Lot No.</td>
      <td colspan="3">Street</td>
    </tr>

    <tr> {{-- Row 27 --}}
      <td colspan="1" rowspan="2">10.</td>
      <td colspan="2" rowspan="2">GSIS ID NO.</td>
      <td colspan="3" rowspan="2"></td>
    </tr>

    <tr>  {{-- Row 28 --}}
      <td colspan="3">Subdivision/Village</td>
      <td colspan="3">Barangay</td>
    </tr>

    <tr> {{-- Row 29 --}}
      <td colspan="1" rowspan="2">11.</td>
      <td colspan="2" rowspan="2">PAG-IBIG ID NO.</td>
      <td colspan="3" rowspan="2"></td>
    </tr>

    <tr>  {{-- Row 30 --}}
      <td colspan="3">City/Municipality</td>
      <td colspan="3">Province</td>
    </tr>

    <tr> {{-- Row 31 --}}
      <td colspan="1">12.</td>
      <td colspan="2">PHILHEALTH NO.</td>
      <td colspan="3"></td>
      <td colspan="2">ZIP CODE</td>
    </tr>

    <tr> {{-- Row 32 --}}
      <td colspan="1">13.</td>
      <td colspan="2">SSS NO.</td>
      <td colspan="3"></td>
      <td colspan="2">19. TELEPHONE NO.</td>
    </tr>

    <tr> {{-- Row 33 --}}
      <td colspan="1">14.</td>
      <td colspan="2">TIN NO.</td>
      <td colspan="3"></td>
      <td colspan="2">20. MOBILE NO.</td>
    </tr>

    <tr> {{-- Row 34 --}}
      <td colspan="1">15.</td>
      <td colspan="2">AGENCY EMPLOYEE NO.</td>
      <td colspan="3"></td>
      <td colspan="2">21. EMAIL ADDRESS (if any)</td>
    </tr>

    <tr> {{-- Row 35 --}}
      <td colspan="14">II. FAMILY BACKGROUND</td>
    </tr>

    <tr> {{-- Row 36 --}}
      <td colspan="1">22. </td>
      <td colspan="2">SPOUSE'S SURNAME</td>
      <td colspan="5"></td>
      <td colspan="4">23. NAME OF CHILDREN (Write full name and list all)</td>
      <td colspan="2">DATE OF BIRTH (mm/dd/yyyy)</td>
    </tr>

    <tr> {{-- Row 37 --}}
      <td colspan="1"></td>
      <td colspan="2">FIRST NAME</td>
      <td colspan="3"></td>
      <td colspan="2">NAME EXTENSION (JR, SR)</td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 38 --}}
      <td colspan="1"></td>
      <td colspan="2">MIDDLE NAME</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 39 --}}
      <td colspan="1"></td>
      <td colspan="2">OCCUPATION</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 40 --}}
      <td colspan="1"></td>
      <td colspan="2">EMPLOYER/BUSINESS NAME</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 41 --}}
      <td colspan="1"></td>
      <td colspan="2">BUSINESS ADDRESS</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 42 --}}
      <td colspan="1"></td>
      <td colspan="2">TELEPHONE NO.</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 43 --}}
      <td colspan="1">24.</td>
      <td colspan="2">FATHER'S SURNAME</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 44 --}}
      <td colspan="1"></td>
      <td colspan="2">FIRST NAME</td>
      <td colspan="3"></td>
      <td colspan="2">NAME EXTENSION (JR, SR)</td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 45 --}}
      <td colspan="1"></td>
      <td colspan="2">MIDDLE NAME</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 46 --}}
      <td colspan="1">25. </td>
      <td colspan="2">MOTHER'S MAIDEN NAME</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 47 --}}
      <td colspan="1"></td>
      <td colspan="2">SURNAME</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 48 --}}
      <td colspan="1"></td>
      <td colspan="2">FIRST NAME</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 49 --}}
      <td colspan="1"></td>
      <td colspan="2">MIDDLE NAME</td>
      <td colspan="5"></td>
      <td colspan="4"></td>
      <td colspan="2"></td>
    </tr>

    <tr> {{-- Row 50 --}}
      <td colspan="14">III. EDUCATIONAL BACKGROUND</td>
    </tr>

    <tr> {{-- Row 51 --}}
      <td colspan="1" rowspan="3">26. </td>
      <td colspan="2" rowspan="3">LEVEL</td>
      <td colspan="3" rowspan="3">NAME OF SCHOOL</td>
      <td colspan="3" rowspan="3">BASIC EDUCATION/DEGREE/COURSE</td>
      <td colspan="2" rowspan="2">PERIOD OF ATTENDANCE</td>
      <td colspan="1" rowspan="3">HIGHEST LEVEL/UNITS EARNED</td>
      <td colspan="1" rowspan="3">YEAR GRADUATED</td>
      <td colspan="1" rowspan="3">SCHOLARSHIP/ACADEMICS HONORS RECEIVED</td>
    </tr>

    <tr> {{-- Row 52 --}}
    </tr>

    <tr> {{-- Row 53 --}}
      <td colspan="1">From</td>
      <td colspan="1">To</td>
    </tr>

    <tr> {{-- Row 54 --}}
      <td colspan="1"></td>
      <td colspan="2">ELEMENTARY</td>
      <td colspan="3"></td>
      <td colspan="3"></td>
      <td colspan="2"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
    </tr>

    <tr> {{-- Row 55 --}}
      <td colspan="1"></td>
      <td colspan="2">SECONDARY</td>
      <td colspan="3"></td>
      <td colspan="3"></td>
      <td colspan="2"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
    </tr>

    <tr> {{-- Row 56 --}}
      <td colspan="1"></td>
      <td colspan="2">VOCATIONAL / TRADE COURSE</td>
      <td colspan="3"></td>
      <td colspan="3"></td>
      <td colspan="2"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
    </tr>

    <tr> {{-- Row 57 --}}
      <td colspan="1"></td>
      <td colspan="2">COLLEGE</td>
      <td colspan="3"></td>
      <td colspan="3"></td>
      <td colspan="2"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
    </tr>

    <tr> {{-- Row 58 --}}
      <td colspan="1"></td>
      <td colspan="2">GRADUATE STUDIES</td>
      <td colspan="3"></td>
      <td colspan="3"></td>
      <td colspan="2"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
    </tr>

    <tr> {{-- Row 59 --}}
      <td colspan="1"></td>
      <td colspan="2"></td>
      <td colspan="3"></td>
      <td colspan="3"></td>
      <td colspan="2"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
      <td colspan="1"></td>
    </tr>

    <tr> {{-- Row 60 --}}
      <td colspan="14">(Continue on separate sheet if necessary)</td>
    </tr>

    <tr> {{-- Row 61 --}}
      <td colspan="3">SIGNATURE</td>
      <td colspan="6"></td>
      <td colspan="2">DATE</td>
      <td colspan="3"></td>
    </tr>

  </table>
</body>

</html>