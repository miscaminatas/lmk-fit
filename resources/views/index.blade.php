@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            @if (Session::has('message') && Session::get('message') == 'added')
            <div class="alert alert-success" role="alert">Deltagare tillagd</div>
            @endif
            @if (Session::has('message') && Session::get('message') == 'reload')
            <div class="alert alert-success" role="alert">Omladdning startad</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Datum \ Deltagare</th>
                        @foreach($participants as $id => $participant)
                            <th>
                                {{ $participant->name }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($fitnessData as $date => $steps)
                    <tr>
                        <td>{{ $date }}</td>
                        @foreach($participants as $id => $participant)
                            <td>
                                @if(isset($steps[$id]))
                                {{ number_format($steps[$id], 0, ',', ' ') }} steps
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>


            <h3>
                Veckans topplista
                <small>{{ $weekTopDates }}</small>
            </h3>
            <table class="table table-toplist">
                <thead>
                    <tr>
                        <th>Plats</th>
                        <th>Deltagare</th>
                        <th>Summa steg</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1; ?>
                    @foreach($weekTop as $fitnessData)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $fitnessData->participant->name }}</td>
                        <td>
                            {{ number_format($fitnessData->total_amount, 0, ',', ' ') }} steg
                            <small class="text-muted">{{ number_format($fitnessData->total_amount/7, 0, ',', ' ') }} steg/dag</small>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>
                Gårdagens topplista
                <small>{{ $yesterdayTopDates }}</small>
            </h3>
            <table class="table table-toplist">
                <thead>
                    <tr>
                        <th>Plats</th>
                        <th>Deltagare</th>
                        <th>Summa steg</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1; ?>
                    @foreach($yesterdayTop as $fitnessData)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $fitnessData->participant->name }}</td>
                        <td>{{ number_format($fitnessData->amount, 0, ',', ' ') }} steg</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <p>
            Senaste omladdningen: {{ $last_reload }}
            </p>
        </div>
    </div>
@stop