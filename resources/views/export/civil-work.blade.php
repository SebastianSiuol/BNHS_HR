<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>C2</title>
</head>

<body>
    <table>
        <tr></tr> {{-- Row 01 --}}

        <tr> {{-- Row 02 --}}
            <td colspan="13">IV. CIVIL SERVICE ELIGIBILITY</td>
        </tr>

        <tr> {{-- Row 03 --}}
            <td colspan="1" rowspan="2">27. </td>
            <td colspan="4" rowspan="2">CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/ CSEE BARANGAY ELIGIBILITY / DRIVER'S LICENSE</td>
            <td colspan="1" rowspan="2">RATING (if Applicable)</td>
            <td colspan="2" rowspan="2">DATE OF EXAMINATION / CONFERMENT</td>
            <td colspan="3" rowspan="2">PLACE OF EXAMINATION / CONFERMENT</td>
            <td colspan="2" rowspan="1">LICENSE (if applicable)</td>
        </tr>

        <tr> {{-- Row 04 --}}
            <td>NUMBER</td>
            <td>DATE OF VALIDITY</td>
        </tr>

        {{-- Row 05 to 11 --}}
        @php
        $civ_services = $faculty->personal_information->civil_services ?? [];
        $row_count = count($civ_services);
        @endphp

        @foreach (range(1, 7) as $i)
        <tr>
            @if ($i <= $row_count)
                @php
                $civ_serv = $civ_services[$i - 1];
                @endphp
                <td colspan="5">{{ $civ_serv->career_service ?? '' }}</td>
                <td colspan="1">{{ $civ_serv->rating ?? '' }}</td>
                <td colspan="2">{{ \Carbon\Carbon::parse($civ_serv->date_of_examination)->format('m-d-Y') ?? '' }}</td>
                <td colspan="3">{{ $civ_serv->place_of_examination ?? '' }}</td>
                <td colspan="1">{{ $civ_serv->license_number ?? '' }}</td>
                <td colspan="1">{{ \Carbon\Carbon::parse($civ_serv->date_of_validity)->format('m-d-Y') ?? '' }}</td>
            @else
                <td colspan="5"></td>
                <td colspan="1"></td>
                <td colspan="2"></td>
                <td colspan="3"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
            @endif
        </tr>
        @endforeach

        <tr> {{-- Row 12 --}}
            <td colspan="13">(Continue on separate sheet if necessary)</td>

        </tr>

        <tr> {{-- Row 13 --}}
            <td colspan="13">V. WORK EXPERIENCE </td>
        </tr>

        <tr> {{-- Row 14 --}}
            <td colspan="13">(Include private employment. Start from your recent work) Description of duties should be indicated in the attached Work Experience sheet.</td>
        </tr>

        <tr> {{-- Row 15 --}}
            <td colspan="1" rowspan="2">28.</td>
            <td colspan="2" rowspan="2">INCLUSIVE DATES (mm/dd/yyyy)</td>
            <td colspan="3" rowspan="3 ">POSITION TITLE(Write in full/Do not abbreviate)</td>
            <td colspan="3" rowspan="3 ">DEPARTMENT / AGENCY / OFFICE / COMPANY (Write in full/Do not abbreviate)</td>
            <td colspan="1" rowspan="3 ">MONTHLY SALARY</td>
            <td colspan="1" rowspan="3 ">SALARY/ JOB/ PAY GRADE (if applicable) STEP (Format "00-0")/ INCREMENT</td>
            <td colspan="1" rowspan="3 ">STATUS OF APPOINTMENT</td>
            <td colspan="1" rowspan="3 ">GOV'T SERVICE (Y/ N)</td>
        </tr>

        <tr> {{-- Row 16 --}}
        </tr>

        <tr> {{-- Row 17 --}}
            <td colspan="2">From</td>
            <td>To</td>
        </tr>

        {{-- Row 18 to 45 --}}
        @foreach (range(1, 28) as $i)
        @php
        $work_exp = $faculty->personal_information->work_experiences ?? [];
        $row_count = count($work_exp);
        @endphp

        <tr>
        @if ($i <= $row_count)
        @php
        $work = $work_exp[$i - 1];
        @endphp
            <td colspan="2">{{ \Carbon\Carbon::parse($work->from_date)->format('m-d-Y') ?? '' }}</td>
            <td colspan="1">{{ \Carbon\Carbon::parse($work->to_date)->format('m-d-Y') ?? '' }}</td>
            <td colspan="3">{{ $work->position_title ?? '' }}</td>
            <td colspan="3">{{ $work->department ?? '' }}</td>
            <td colspan="1">{{ $work->monthly_salary ?? '' }}</td>
            <td colspan="1">{{ $work->salary_grade ?? '' }}</td>
            <td colspan="1">{{ $work->gov_service ?? '' }}</td>
        @else
            <td colspan="2"></td>
            <td colspan="1"></td>
            <td colspan="3"></td>
            <td colspan="3"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
        </tr>
        @endif
        @endforeach

        <tr> {{-- Row 46 --}}
            <td colspan="13">(Continue on separate sheet if necessary)</td>
        </tr>

        <tr> {{-- Row 47 --}}
            <td colspan="3">SIGNATURE</td>
            <td colspan="5"></td>
            <td colspan="1">DATE</td>
            <td colspan="4"></td>
        </tr>

    </table>
</body>

</html>