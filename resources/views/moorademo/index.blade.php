@extends('layouts.appdemo')

@section('content')
<form method="POST" action="{{ route('moorademo.store') }}">
    @csrf
    <div class="mb-3">
        <label for="user_id" class="form-label">User ID</label>
        <input type="text" name="user_id" class="form-control" required>
    </div>

@foreach($criterias as $criteria)
                                                                    <div class="mb-3">
                                                                        <label class="form-label font-semibold">Kriteria {{ $criteria['NAME'] }}</label>
                                                                        <select name="criteria[{{ $criteria['CRITERIA_ID'] }}]" class="form-select" required>
                                                                            <option value="" disabled selected>-- Pilih Jawaban --</option>
                                                                            @switch(strtolower($criteria['NAME']))
                                                                                @case('harga')
                                                                                @case('biaya pemeliharaan')
                                                                                    <option value="4">Sangat Penting</option>
                                                                                    <option value="3">Penting</option>
                                                                                    <option value="2">Tidak Terlalu Penting</option>
                                                                                    <option value="1">Tidak Penting</option>
                                                                                    @break

                                                                                @case('kompleksitas pemeliharaan')
                                                                                                                                                                        <option value="4">Sangat Penting</option>
                                                                                    <option value="3">Penting</option>
                                                                                    <option value="2">Tidak Terlalu Penting</option>
                                                                                    <option value="1">Tidak Penting</option>
                                                                                    @break

                                                                                @case('kelangkaan')
                                                                                                                                                                        <option value="4">Sangat Penting</option>
                                                                                    <option value="3">Penting</option>
                                                                                    <option value="2">Tidak Terlalu Penting</option>
                                                                                    <option value="1">Tidak Penting</option>
                                                                                    @break

                                                                                @case('ukuran')
                                                                                                                                                                        <option value="4">Sangat Penting</option>
                                                                                    <option value="3">Penting</option>
                                                                                    <option value="2">Tidak Terlalu Penting</option>
                                                                                    <option value="1">Tidak Penting</option>
                                                                                    @break

                                                                                @case('estetika')
                                                                                                                                                                        <option value="4">Sangat Penting</option>
                                                                                    <option value="3">Penting</option>
                                                                                    <option value="2">Tidak Terlalu Penting</option>
                                                                                    <option value="1">Tidak Penting</option>
                                                                                    @break

                                                                                @case('perilaku')
                                                                                                                                                                        <option value="4">Sangat Penting</option>
                                                                                    <option value="3">Penting</option>
                                                                                    <option value="2">Tidak Terlalu Penting</option>
                                                                                    <option value="1">Tidak Penting</option>
                                                                                    @break

                                                                                @default
                                                                                                                                                                        <option value="4">Sangat Penting</option>
                                                                                    <option value="3">Penting</option>
                                                                                    <option value="2">Tidak Terlalu Penting</option>
                                                                                    <option value="1">Tidak Penting</option>
                                                                            @endswitch
                                                                        </select>
                                                                    </div>
                                                                @endforeach

                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                </form>
<h2>Result</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>RESULT_ID</th>
            <th>TIME_ADDED</th>
            <th>USER_ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $row)
        <tr>
            <td>{{ $row->RESULT_ID }}</td>
            <td>{{ $row->TIME_ADDED }}</td>
            <td>{{ $row->USER_ID }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Result Detail</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>RESULT_DETAIL_ID</th>
            <th>RANKING</th>
            <th>RESULT_ID</th>
            <th>FISH_ID</th>
            <th>SCORE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resultDetails as $row)
        <tr>
            <td>{{ $row->RESULT_DETAIL_ID }}</td>
            <td>{{ $row->RANKING }}</td>
            <td>{{ $row->RESULT_ID }}</td>
            <td>{{ $row->FISH_ID }}</td>
            <td>{{ $row->SCORE }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Master Criteria</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>MASTER_CRITERIA_ID</th>
            <th>USER_ID</th>
            <th>CRITERIA_ID</th>
            <th>WEIGHT_TXT</th>
            <th>WEIGHT_INT</th>
            <th>RESULT_ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($masterCriteria as $row)
        <tr>
            <td>{{ $row->MASTER_CRITERIA_ID }}</td>
            <td>{{ $row->USER_ID }}</td>
            <td>{{ $row->CRITERIA_ID }}</td>
            <td>{{ $row->WEIGHT_TXT }}</td>
            <td>{{ $row->WEIGHT_INT }}</td>
            <td>{{ $row->RESULT_ID }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Criteria</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>CRITERIA_ID</th>
            <th>NAME</th>
            <th>TYPE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($criterias as $row)
        <tr>
            <td>{{ $row->CRITERIA_ID }}</td>
            <td>{{ $row->NAME }}</td>
            <td>{{ $row->TYPE }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Master Alternatives</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>MASTER_ALTERNATIVES_ID</th>
            <th>CRITERIA_ID</th>
            <th>FISH_ID</th>
            <th>VALUE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($masterAlternatives as $row)
        <tr>
            <td>{{ $row->MASTER_ALTERNATIVES_ID }}</td>
            <td>{{ $row->CRITERIA_ID }}</td>
            <td>{{ $row->FISH_ID }}</td>
            <td>{{ $row->VALUE }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
