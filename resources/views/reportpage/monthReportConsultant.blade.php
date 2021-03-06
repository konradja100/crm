@extends('layouts.main')
@section('content')

    {{--Header page --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <div class="alert gray-nav">Raport Miesięczny Konsultanci</div>
            </div>
        </div>
    </div>
    <form method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Trener:</label>
                    <select class="form-control" id="coach_id" name="coach_id">
                        <option>Wybierz</option>
                        @foreach($coaches as $item)
                            <option @if($item->id == $coach_selected) selected @endif value="{{ $item->id }}">{{ $item->last_name . ' ' . $item->first_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Miesiąc:</label>
                    <select class="form-control" id="month_selected" name="month_selected">
                        @foreach($months as $key => $value)
                            <option @if($key == $month) selected @endif value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Generuj raport" style="width: 100%; margin-top: 24px">
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="start_stop">
                            <div class="panel-body">
                                @isset($data)
                                    @include('mail.monthReportConsultant')
                                @else
                                    <div class="alert alert-info">
                                        Wybierz konsultanta
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('script')
    <script>

    </script>
@endsection
