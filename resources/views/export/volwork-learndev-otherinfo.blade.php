<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>C3</title>
</head>

<body>
  <table>
    <tr>{{-- Row 01--}}
    </tr>

    <tr> {{-- Row 02 --}}
      <td colspan="11">
        VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S
      </td>
    </tr>

    <tr> {{-- Row 03--}}
      <td colspan="1" rowspan="3">
        29.
      </td>
      <td colspan="3" rowspan="3">
        NAME AND ADDRESS OF ORGANIZATION (Write in full)
      </td>
      <td colspan="2" rowspan="2">
        INCLUSIVE DATES
      </td>
      <td colspan="1" rowspan="3">
        NUMBER OF HOURS
      </td>
      <td colspan="4" rowspan=3">
        POSITION / NATURE OF WORK
      </td>
    </tr>

    <tr> {{-- Row 04--}}
    </tr>

    <tr> {{-- Row 05--}}
      <td>From</td>
      <td>To</td>
    </tr>

    {{-- Row 06 to 12 --}}
    @php
    $vol_work = $faculty->personal_information->voluntary_works ?? [];
    $row_count = count($vol_work);
    @endphp

    @foreach (range(1, 7) as $i)
    <tr>
      @if ($i <= $row_count)
        @php
        $work = $vol_work[$i - 1];
        @endphp
        <td colspan="4">{{ $work->organization_name ?? '' }}</td>
        <td colspan="1">{{ \Carbon\Carbon::parse($work->date_from)->format('m-d-Y') ?? '' }}</td>
        <td colspan="1">{{ \Carbon\Carbon::parse($work->date_to)->format('m-d-Y') ?? '' }}</td>
        <td colspan="1">{{ $work->hours ?? '' }}</td>
        <td colspan="4">{{ $work->position ?? '' }}</td>
        @else
        <td colspan="4"></td>
        <td colspan="1"></td>
        <td colspan="1"></td>
        <td colspan="1"></td>
        <td colspan="4"></td>
        @endif
    </tr>
    @endforeach

    <tr> {{-- Row 13--}}
      <td colspan="11">(Continue on separate sheet if necessary)</td>
    </tr>

    <tr> {{-- Row 14--}}
      <td colspan="11">VII. LEARNING AND DEVELOPMENT (LandD) INTERVENTIONS/TRAINING PROGRAMS ATTENDED</td>
    </tr>

    <tr> {{-- Row 15--}}
      <td colspan="11">(Start from the most recent LD/traning program and include only the relevant LD/traning taken for the last (5) years for Division/Chief/Managerial positions)</td>
    </tr>

    <tr> {{-- Row 16--}}
      <td colspan="1" rowspan="3">
        30.
      </td>
      <td colspan="3" rowspan="3">
        TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS (Write in full)
      </td>
      <td colspan="2" rowspan="2">
        INCLUSIVE DATES
      </td>
      <td colspan="1" rowspan="3">
        NUMBER OF HOURS
      </td>
      <td colspan="1" rowspan="3">
        Type of LD ( Managerial/Supervisory/Technical/etc)
      </td>
      <td colspan="3" rowspan=3">
        CONDUCTED / SPONSORED BY (Write in full)
      </td>
    </tr>

    <tr> {{-- Row 17--}}
    </tr>

    <tr> {{-- Row 18--}}
      <td>From</td>
      <td>To</td>
    </tr>

    {{-- Row 19 to 37 --}}
    @php
    $l_n_d = $faculty->personal_information->learning_and_developments ?? []; // Retrieve the relationship or default to an empty array
    $row_count = count($l_n_d);
    @endphp

    @foreach (range(1, 19) as $i)
    <tr>
      @if ($i <= $row_count)
        @php
        $ld = $l_n_d[$i - 1];
        @endphp
        <td colspan="4">{{ $ld->title ?? '' }}</td>
        <td colspan="1">{{ \Carbon\Carbon::parse($ld->date_from)->format('m-d-Y') ?? '' }}</td>
        <td colspan="1">{{ \Carbon\Carbon::parse($ld->date_to)->format('m-d-Y') ?? '' }}</td>
        <td colspan="1">{{ $ld->hours ?? ''}}</td>
        <td colspan="1">{{ $ld->type ?? ''}}</td>
        <td colspan="3">{{ $ld->conducted_by ?? ''}}</td>

      @else
        <td colspan="4"></td>
        <td colspan="1"></td>
        <td colspan="1"></td>
        <td colspan="1"></td>
        <td colspan="1"></td>
        <td colspan="3"></td>
      @endif
    </tr>
    @endforeach

    <tr> {{-- Row 38--}}
      <td colspan="11">(Continue on separate sheet if necessary)</td>
    </tr>

    <tr> {{-- Row 39 --}}
      <td colspan="11">
        VIII. OTHER INFORMATION
      </td>
    </tr>

    <tr> {{-- Row 40 --}}
      <td colspan="1">
        31.
      </td>
      <td colspan="1">
        SPECIAL SKILLS and HOBBIES
      </td>
      <td colspan="1">
        32.
      </td>
      <td colspan="5">
        NON-ACADEMIC DISTINCTIONS / RECOGNITION (Write in full)
      </td>
      <td colspan="1">
        33.
      </td>
      <td colspan="2">
        MEMBERSHIP IN ASSOCIATION/ORGANIZATION (Write in full)
      </td>
    </tr>

    {{-- Row 41 to 47 --}}
    @php
    $other_info = $faculty->personal_information->other_information ?? []; // Retrieve the relationship or default to an empty array
    $row_count = count($other_info);
    @endphp
    @foreach (range(1, 7) as $i)
    <tr>
    @if ($i <= $row_count)
      @php
      $info = $other_info[$i - 1];
      @endphp
      <td colspan="2">{{ $info->special_skills ?? ''}}</td>
      <td colspan="6">{{ $info->distinctions }}</td>
      <td colspan="3">{{ $info->memberships }}</td>
    @else
      <td colspan="2"></td>
      <td colspan="6"></td>
      <td colspan="3"></td>
    </tr>
    @endif
    @endforeach

    <tr> {{-- Row 48--}}
      <td colspan="11">(Continue on separate sheet if necessary)</td>
    </tr>

    <tr> {{-- Row 49 --}}
      <td colspan="2">SIGNATURE</td>
      <td colspan="4"></td>
      <td colspan="2">DATE</td>
      <td colspan="3"></td>
    </tr>

  </table>
</body>

</html>