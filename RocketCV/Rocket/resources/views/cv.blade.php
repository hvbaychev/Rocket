@extends('layouts.index')
@section('content')

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        #popup {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f0f0f0;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>

    <script>
        $(document).ready(function() {
            $("form").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('createCv.create') }}",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert("CV created successfully!");
                        } else {
                            alert("Error creating CV: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred: " + error);
                    }
                });
            });
        });
    </script>


</head>

<div class="container bootstrap snippets bootdey">
    <div class="row ng-scope">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <br>
                    <br>
                    <div class="h4 text-center">Make Your Own CV:</div>
                    <div class="row pv-lg">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form class="form-horizontal ng-pristine ng-valid" action="@" method="POST">
                                @method('POST')
                                @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                                @endif
                                @if(Session::has('fail'))
                                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="first_name">First Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="first_name" name="first_name" type="text" placeholder="" value="{{ Session::has('loginId') ? $data->first_name : '' }}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="middle_name">Mid Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="middle_name" name="middle_name" type="text" placeholder="" value="{{ Session::has('loginId') ? $data->middle_name : '' }}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="last_name">Last Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="last_name" name="last_name" type="text" placeholder="" value="{{ Session::has('loginId') ? $data->last_name : '' }}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="birth_date">Birth Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="birth_date" name="birth_date" type="text" value="{{ Session::has('loginId') ? $data->birth_date : '' }}" autocomplete="off">
                                    </div>
                                </div>
                                <br>



                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="universities_id">University:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="universities_id_select" name="universities_id" style="background-color: white;">
                                            <option value="">Select University</option>
                                            @foreach ($universities as $university)
                                            <option value="{{ $university->id }}">{{ $university->name }}</option>
                                            @endforeach
                                        </select>
                                        <button id="openPopup">Add new University</button>
                                        <div id="popup">
                                            <label for="newOption">New University</label>
                                            <input type="text" id="newOption">
                                            <button id="addOption">Add</button>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    const popupUniversity = document.getElementById('popup');
                                    const openPopupButtonUniversity = document.getElementById('openPopup');
                                    const newOptionInputUniversity = document.getElementById('newOption');
                                    const addOptionButtonUniversity = document.getElementById('addOption');
                                    const universitiesSelect = document.getElementById('universities_id_select'); // Добавете този ред

                                    openPopupButtonUniversity.addEventListener('click', () => {
                                        popupUniversity.style.display = 'block';
                                    });

                                    addOptionButtonUniversity.addEventListener('click', () => {
                                        const newOptionValue = newOptionInputUniversity.value;
                                        if (newOptionValue) {
                                            // Не трябва да добавяте ново CV, а нов университет
                                            $.ajax({
                                                type: "POST",
                                                url: "{{ route('universities.create') }}",
                                                data: {
                                                    newUniversity: newOptionValue,
                                                    _token: "{{ csrf_token() }}"
                                                },
                                                success: function(response) {
                                                    if (response.success) {
                                                        // Добавете нов университет към селект полето
                                                        const newOption = new Option(newOptionValue, response.universityId);
                                                        universitiesSelect.appendChild(newOption);
                                                        newOptionInputUniversity.value = '';
                                                        popupUniversity.style.display = 'none';
                                                        alert(response.message);
                                                    } else {
                                                        alert("Error creating university: " + response.message);
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    alert("An error occurred: " + error);
                                                }
                                            });
                                        }
                                    });
                                </script>







                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="technologies_id">Technologies:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="technologies_id_select" name="technologies_id" style="background-color: white;">
                                            <option value="">Select Technology</option>
                                            @foreach ($technologies as $technology)
                                            <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                                            @endforeach
                                        </select>
                                        <button id="addTechButton">Add new Technology</button>
                                        <div id="addTechModal">
                                            <label for="newTechnology">New Technology</label>
                                            <input type="text" id="newTechnology">
                                            <button id="addTechnology">Add</button>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    const popupTech = document.getElementById('addTechModal');
                                    const openPopupButtonTech = document.getElementById('addTechButton');
                                    const newOptionInputTech = document.getElementById('newTechnology');
                                    const addOptionButtonTech = document.getElementById('addTechnology');
                                    const technologiesSelect = document.getElementById('technologies_id_select'); // Добавете този ред

                                    openPopupButtonTech.addEventListener('click', () => {
                                        popupTech.style.display = 'block';
                                    });

                                    addOptionButtonTech.addEventListener('click', () => {
                                        const newOptionValue = newOptionInputTech.value;
                                        if (newOptionValue) {
                                            // Не трябва да добавяте ново CV, а нова технология
                                            $.ajax({
                                                type: "POST",
                                                url: "{{ route('technologies.create') }}",
                                                data: {
                                                    newTechnology: newOptionValue,
                                                    _token: "{{ csrf_token() }}"
                                                },
                                                success: function(response) {
                                                    if (response.success) {
                                                        // Добавете нова технология към селект полето
                                                        const newOption = new Option(newOptionValue, response.technologyId);
                                                        technologiesSelect.appendChild(newOption);
                                                        newOptionInputTech.value = '';
                                                        popupTech.style.display = 'none';
                                                        alert(response.message);
                                                    } else {
                                                        alert("Error creating technology: " + response.message);
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    alert("An error occurred: " + error);
                                                }
                                            });
                                        }
                                    });
                                </script>

                                <br>
                                <br>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-info" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#birth_date").datepicker({
            dateFormat: 'yy-mm-dd', // Формат на датата
            changeMonth: true,
            changeYear: true
        });
    });
</script>


@endsection
