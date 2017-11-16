@extends('layouts.main')
@section('content')


    <style>
        .edit{
            background-color: #FFFFFF;
            border:0;
        }
        .edit:hover{
            color:#a7a7a7;
        }
        .edit:active{
            border:0;
        }
        .edit-name{
            display:none;
        }
        .edit-surname{
            display:none;
        }
        .edit-doc{
            display:none;
        }
        .edit-stu{
            display:none;
        }
        .edit-statuswork{
            display:none;
        }
        .edit-phonework{
            display:none;
        }
        .edit-phonepriv{
            display:none;
        }
        .edit-datework{
            display:none;
        }
        .edit-money{
            display:none;
        }
        .edit-addmoney{
            display:none;
        }
    </style>

    <!-- Main -->
    <div class="container">
        <div class="row">
            <!-- center left-->
            <div class="col-md-12">
                <hr>
                <!-- <div class="alert alert-danger" role="alert">Niestety ta funkcja nie jest jeszcze dostępna.</div> -->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Profil Pracownika</h3>
                    </div>
                    <div class="panel-body">
                        <!-- <div class="col-md-2 col-lg-2 " align="center"> <img alt="User Pic" src="http://saintgeorgelaw.com/wp-content/uploads/2015/01/male-formal-business-hi.png" class="img-circle img-responsive" style="border:2px solid #222;"> </div> -->
                        <div class="col-md-10">

                            <div class=" col-md-6 col-lg-6 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <b style="font-size: 20px; font-family: sans-serif;">Dane Osobowe</b>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Imię:</b></td>
                                        <td>
                                            <input type="text" class="form-control" name="first_name" placeholder="Imię" value="{{$user->first_name}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Nazwisko:</b></td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Nazwisko" name="last_name"  value="{{$user->last_name}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>E-mail:</b></td>
                                        <td>
                                            <input type="mail" class="form-control" placeholder="Email" name="email"  value="{{$user->email_off}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Telefon służbowy:</b></td>
                                        <td>
                                            <input type="number" pattern="[0-9]*" class="form-control" placeholder="format: 000000000" name="work_phone" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Telefon prywatny:</b></td>
                                        <td>
                                            <input type="number" pattern="[0-9]*" class="form-control" placeholder="format: 000000000" name="private_phone" value="{{$user->phone}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Login(Godzinówka):</b></td>
                                        <td><input type="text" class="form-control" placeholder="Login" name="username" value="{{$user->username}}"></td>

                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Hasło:</b></td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Hasło" name="password"  value="">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Dokumenty:</b></td>
                                        <td>
                                            <select class="form-control" style="font-size:18px;" name="documents" >
                                                <option value="1" @if($user->documents == 1) selected @endif>Tak</option>
                                                <option value="0" @if($user->documents == 0) selected @endif>Nie</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Student:</b></td>
                                        <td>
                                            <select class="form-control" style="font-size:18px;" name="student">
                                                <option value="1" @if($user->student == 1) selected @endif>Tak</option>
                                                <option value="0" @if($user->student == 0) selected @endif>Nie</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Agencja:</b></td>
                                        <td>
                                            <select class="form-control" style="font-size:18px;" name="agency_id" >
                                                @foreach($agencies as $agency)
                                                    <option value="{{$agency->id}}" @if($user->agency_id == $agency->id) selected @endif>{{$agency->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class=" col-md-6 col-lg-6 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <b style="font-size: 20px; font-family: sans-serif;">Informacje cd</b>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Rozpoczęcie Pracy:</b></td>
                                        <td>
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="datak" style="width:100%;">
                                                <input class="form-control" name="start_date" type="text" value="{{$user->start_work}}" readonly >
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Zakończenie Pracy:</b></td>
                                        <td>
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="datak" style="width:100%;">
                                                @if(isset($user->end_work))
                                                    <input class="form-control" name="stop_date" type="text" value="{{$user->end_work}}" readonly >
                                                @else
                                                    <input class="form-control" name="stop_date" type="text" value="{{date('Y-m-d')}}" readonly >
                                                @endif

                                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Stawka na godzine:</b></td>
                                        <td>
                                            <select class="form-control" style="font-size:18px;" name="rate" >
                                                <option>Nie dotyczy</option>
                                                @for ($i = 7.00; $i <=14; $i+=0.5)
                                                    <option value="{{number_format ($i,2)}}" @if($user->rate == $i) selected @endif>{{number_format ($i,2)}}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Wynagrodzenie:</b></td>
                                        <td>
                                          @if(isset($user->salary))
                                              <input type="number" class="form-control" placeholder="0" name="salary" value="{{$user->salary}}">
                                          @else
                                              <input type="number" class="form-control" placeholder="0" name="salary" value="0">
                                          @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Dodatek slużbowy:</b></td>
                                        <td>
                                            <input type="number" class="form-control" placeholder="0" name="additional_salary" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Całość na konto:</b></td>
                                        <td>
                                            <select class="form-control" style="font-size:18px;" name="salary_to_account">
                                                <option value="1" @if($user->salary_to_account == 1) selected @endif>Tak</option>
                                                <option value="0" @if($user->salary_to_account == 0) selected @endif>Nie</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Premia (Październik):</b></td>
                                        <td>
                                            <input type="number" class="form-control" placeholder="0" name="additional_salary_1st_month" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Premia (Listopad):</b></td>
                                        <td>
                                            <input type="number" class="form-control" placeholder="0" name="additional_salary_2nd_month" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 170px;height:52px;"><b>Login PBX:</b></td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="Login z programu do dzwonienia" name="login_phone" value="">
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class=" col-md-10 col-lg-10 ">
    		                  <table class="table table-user-information">
    		                    <tbody>
    		                    <b style="font-size: 20px; font-family: sans-serif;">Kary i Premie</b>
    		                      <tr>
    		                        <td><b>Data</b></td>
    		                        <td><b>Kara/Premia</b></td>
    		                        <td><b>Dodał</b></td>
    		                        <td><b>Powód</b></td>
    		                        <td></td>
    		                      </tr>
                              @foreach($user->penalty_bonuses as $penalty)
                                  <tr>
        		                        <td nowrap="nowrap">{{$penalty->event_date}}</td>
                                    @if($penalty->type == 2)
                                        <td nowrap="nowrap"><span style="background-color: #70ff5c; padding: 4px 10px;border-radius: 5px;border:1px solid #33ff36; color:#4b5c44;">Premia: {{$penalty->amount}} zł</span></td>
                                    @else
                                        <td nowrap="nowrap"><span style="background-color: #ff7b7b; padding: 4px 10px;border-radius: 5px;border:1px solid #ff6a6a; color:#7f2222;">Kara: {{$penalty->amount}} zł</span></td>
                                    @endif
        		                        <td nowrap="nowrap"><span style="background-color: #d9edf7; padding: 4px 10px;border-radius: 5px;border:1px solid #bce8f1; color:#31708f;">{{$penalty->manager->first_name . ' ' . $penalty->manager->last_name}}</span></td>
        		                        <td>{{$penalty->comment}}</td>
        		                        <td><a type="button" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" style="height: 20px; padding-top:3px; padding-left: 0px;" data-toggle="modal" data-target="#karta_oceny"></i></a></td>
        		                      </tr>
                              @endforeach
                              @if (Session::has('message'))
                                 <div class="alert alert-success">{{ Session::get('message') }}</div>
                              @endif

    							            <tr>
                                  <form method="POST" action="/view_penalty_bonus_edit">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <input type="hidden" name="user_id" value="{{$user->id}}">
          		                        <td colspan="2"><select class="form-control" name="penalty_type">
          		                        	<option>Wybierz</option>
          		                        	<option value="1">Kara</option>
          		                        	<option value="2">Premia</option>
          		                        </select></td>
          		                        <td><input type="number" placeholder="0" name="cost" class="form-control"></td>
          		                        <td colspan="2"><input type="text" placeholder="Powód" name="reason" class="form-control"></td>

          		                        <td><input type="submit" id="addpbsubmit"></td>
                                  </form>
    		                      </tr>

    		                    </tbody>
    		                  </table>
    		                </div>
                        <!-- <div class=" col-md-10 col-lg-10 ">
    		                  <table class="table table-user-information">
    		                    <tbody>
    		                    <b style="font-size: 20px; font-family: sans-serif;">Posiadany Sprzęt</b>
    		                      <tr>
    		                        <td style="width: 10px;"><b>Lp.</b></td>
    		                        <td><b>Data Wyd.</b></td>
    		                        <td><b>Sprzęt</b></td>
    		                        <td style="width: 10px;"></td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 10px;"><b>1.</td>
    		                        <td>2017-02-01</td>
    		                        <td>Laptop</td>
    		                        <td style="width: 10px;"><a type="button" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#laptop"></i></a></td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 10px;"><b>2.</td>
    		                        <td>2017-02-01</td>
    		                        <td>Telefon</td>
    		                        <td style="width: 10px;"><a type="button" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#telefon"></i></a></td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 10px;"><b>2.</td>
    		                        <td>2017-02-01</td>
    		                        <td>Karta SIM</td>
    		                        <td style="width: 10px;"><a type="button" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#sim"></i></a></td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 10px;"><b>3.</td>
    		                        <td>2017-02-01</td>
    		                        <td>Monitor</td>
    		                        <td style="width: 10px;"><a type="button" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#monitor"></i></a></td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 10px;"><b>4.</td>
    		                        <td>2017-02-01</td>
    		                        <td>Monitor</td>
    		                        <td style="width: 10px;"><a type="button" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#monitor"></i></a></td>
    		                      </tr>

    		                    </tbody>
    		                  </table>
    		                </div> -->
            </div>
        </div>
    </div>
    <!--/container-->
    <!-- /Main -->
    <div class="modal">

    </div>

    <!-- Laptop -->
    <!-- <div class="modal fade" id="laptop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div style="width:370px; margin:0 auto; background-color:#fff; border-radius:6px;border: 1px solid rgba(0,0,0,.2);">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Informacje o sprzęcie Służbowym</h4>
          </div>
          <div class="modal-body">
           				 <table class="table table-user-information">
    		                    <tbody>
    		                    <b style="font-size: 20px; font-family: sans-serif;">Laptop</b>
    		                      <tr>
    		                        <td style="width: 100px;"><b>Data Wydania</b></td>
    		                        <td style="width: 10px;">2017-03-04</td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 100px;"><b>Model</b></td>
    		                        <td style="width: 10px;">MSI CX70</td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 100px;"><b>Numer seryjny</b></td>
    		                        <td style="width: 10px;">FWE186WE418CWE1</td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 100px;"><b>Procesor</b></td>
    		                        <td style="width: 10px;">Intel Core i7</td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 100px;"><b>Pamięć Ram</b></td>
    		                        <td style="width: 10px;">8GB DDR3(PC3)</td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 100px;"><b>Dysk</b></td>
    		                        <td style="width: 10px;">1000GB</td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 100px;"><b>Modyfikacje</b></td>
    		                        <td style="width: 10px;">Rozszerzenie Ram 8GB</td>
    		                      </tr>
    		                      <tr>
    		                        <td style="width: 100px;"><b>Uwagi</b></td>
    		                        <td style="width: 10px;">Brak</td>
    		                      </tr>
    		                    </tbody>
    		                  </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij okno</button>
          </div>
        </div>
      </div>
    </div> -->

@endsection
@section('script')

<script>

$("#addpbsubmit").click(function () {

    var penalty_type = $("select[name='penalty_type']").val();
    var cost = $("input[name='cost']").val();
    var reason = $("input[name='reason']").val();

    if (penalty_type == "Wybierz") {
        alert("Wybierz rodzaj kary/nagrody!");
        return false;
    }

    if (cost == '') {
        alert("Podaj kwotę!");
        return false;
    }

    if (reason == '') {
        alert("Podaj powód!");
        return false;
    }

});

    $("#edit-name-button").click(function(){
        $(".name").fadeOut();
        $(".edit-name").delay(500).fadeIn();

    });
    $("#edit-surname-button").click(function(){
        $(".surname").fadeOut();
        $(".edit-surname").delay(500).fadeIn();

    });
    $("#edit-doc-button").click(function(){
        $(".doc").fadeOut();
        $(".edit-doc").delay(500).fadeIn();

    });
    $("#edit-stu-button").click(function(){
        $(".stu").fadeOut();
        $(".edit-stu").delay(500).fadeIn();

    });
    $("#edit-statuswork-button").click(function(){
        $(".statuswork").fadeOut();
        $(".edit-statuswork").delay(500).fadeIn();

    });
    $("#edit-phonework-button").click(function(){
        $(".phonework").fadeOut();
        $(".edit-phonework").delay(500).fadeIn();

    });
    $("#edit-phonepriv-button").click(function(){
        $(".phonepriv").fadeOut();
        $(".edit-phonepriv").delay(500).fadeIn();

    });
    $("#edit-datework-button").click(function(){
        $(".datework").fadeOut();
        $(".edit-datework").delay(500).fadeIn();

    });
    $("#edit-money-button").click(function(){
        $(".money").fadeOut();
        $(".edit-money").delay(500).fadeIn();

    });
    $("#edit-addmoney-button").click(function(){
        $(".addmoney").fadeOut();
        $(".edit-addmoney").delay(500).fadeIn();

    });
    $("#edit-branch-button").click(function(){
        $(".branch").fadeOut();
        $(".edit-branch").delay(500).fadeIn();

    });
    $("#edit-priv-button").click(function(){
        $(".priv").fadeOut();
        $(".edit-priv").delay(500).fadeIn();

    });
    $("#edit-agency-button").click(function(){
        $(".agency").fadeOut();
        $(".edit-agency").delay(500).fadeIn();

    });

</script>
@endsection
