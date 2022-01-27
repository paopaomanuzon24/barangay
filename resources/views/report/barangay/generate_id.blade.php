{{-- <!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>

    <style>
        #backTitle {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 48px;
        }
    </style>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group text-center">
                        <span id="backTitle">
                            <strong>IN CASE OF EMERGENCY, PLS. NOTIFY:</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <br>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <span>Name:</span>
                    </div>
                    <div class="form-group">
                        <span>Name:</span>
                    </div>
                    <div class="form-group">
                        <span>Name:</span>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <span>Name:</span>
                    </div>
                    <div class="form-group">
                        <span>Name:</span>
                    </div>
                    <div class="form-group">
                        <span>Name:</span>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>BARANGAY ID</title>
</head>
<style>
    /* body{
        background: pink;
    } */

    .container {
        padding-right: 50px;
        padding-left: 50px;
        margin-right: auto;
        margin-left: auto;
    }

    .logoLeftPosition {
        position: absolute !important;
        top: 1cm;
        left: 1cm;
    }

    .logoRightPosition {
        position: absolute !important;
        top: 1cm;
        right: 1cm;
    }

    .idPicturePosition {
        position: absolute !important;
        top: 6cm;
    }

    .userDetails {
        position: absolute !important;
        width: 50%;
        right: 1cm;
        top: 8cm;
    }

    .brgyChairman {
        position: absolute !important;
        width: 50%;
        right: 0.5cm;
        top: 17cm;
    }
    
    .frontTitle {
        font-size: 54px !important;
        letter-spacing: 4px;
    }

    .fontSize2 {
        font-size: 18px !important;
    }

    .backTitleSize {
        font-size: 48px !important;
    }

    .backSecondTitleSize {
        font-weight: normal !important;
        letter-spacing: 4px;
    }

    .font1 {
        font-family: Arial, Helvetica, sans-serif;
    }

    .font2 {
        font-family: "Lucida Console", "Courier New", monospace;
    }

    .white-color {
        color: #fff !important;
    }

    .black-color {
        color: #000 !important;
    }

    .grey-color {
        color: #5f5f5f !important;
    }

    .backDetails {
        width: 50%;
    }

    @page { margin: 1px; }
</style>

{{-- ID FRONT --}}
<body style="background-image: url({{url('/')}}/images/sample-id-bg.jpg); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div>
            <br><br>
            <center>
                <h1>
                    <span class="font1 frontTitle black-color">{{ strtoupper($title) }}</span><br>
                    <span class="font1 fontSize2 black-color">LONGOS BRGY. HALL HITO ST. MALABON CITY</span><br>
                    <span class="font1 fontSize2 black-color">TEL NO. (02) 441-4807 - E-MAIL ADD. BARANGAY@GMAIL.COM</span>
                </h1>
            </center>
        </div>
        <div class="logoLeftPosition">
            <img src="{{ url('/') }}/images/barangay-logo.png" alt="" height="150px" width="150px">
        </div>
        <div class="logoRightPosition">
            
            <img src="data:image/png;base64, '{{ $qrCode }}'" height="150px" width="150px"/>
            {{-- <img src="{{ url('/') }}/images/sample-qr.png" alt="" height="150px" width="150px"> --}}
            {{-- {!! QrCode::size(300)->generate('Hello World') !!} --}}
        </div>
        <div class="idPicturePosition">
            <div>
                <center>
                    @if (!empty($id_picture))
                        <img src="data:image/png;base64, '{{ $id_picture }}'" alt="" height="400px" width="400px">
                    @else
                        <img src="{{ url('/') }}/images/sample-picture.PNG" alt="" height="400px" width="400px">
                    @endif
                </center>
            </div>
            <div style="background: #fff; border-radius: 50%;">
                <center>
                    <h1 class="font2">
                        BRGY ID: {{ $residentID }}
                    </h1>
                </center>
            </div>
            <div>
                <center>
                    <h1 class="font1" style="font-weight: 500px;">Valid Until {{ date("F d, Y", strtotime($dateExpiration)) }}</h1>
                </center>
            </div>
        </div>
        <div class="userDetails">
            <div>
                <center>
                    <h1 class="font2">
                        {{ $name }}
                    </h1>
                </center>
                <center>
                    <h2 class="font2 grey-color">
                        {{ $address }} <br>
                        {{ $birthDate }}
                    </h2>
                </center>
            </div>
        </div>
        <div class="brgyChairman">
            <div>
                <center>
                    <h2 class="font1">
                        <img style="position: absolute !important; top: -2.5cm; right: 5cm;" src="{{ url('/') }}/images/sample-signature.PNG" alt="" height="150px" width="150px"><br>
                        Barangay Chairman Name <br>
                        Barangay Chairman
                    </h2>
                </center>
            </div>
        </div>
    </div>
</body>

{{-- ID BACK --}}
<body style="background-image: url({{url('/')}}/images/sample-id-bg.jpg); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="font1">
            <br><br>
            <center>
                <h1 class="backTitleSize">IN CASE OF EMERGENCY, PLS. NOTIFY</h1>
            </center>
        </div>

        <table>
            {{-- <tr>
                <td rowspan="4">
                    <img src="{{ url('/') }}/images/sample-qr.png" alt="" width="150px" height="150px">
                </td>
            </tr> --}}
            <tr>
                <td>
                    <h2 class="font2 grey-color">Name:</h2>
                </td>
                <td>
                    <h2 class="font2 grey-color">{{ $name }}</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <h2 class="font2 grey-color">Address:</h2>
                </td>
                <td>
                    <h2 class="font2 grey-color">{{ $address }}</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <h2 class="font2 grey-color">Contact No.: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                </td>
                <td>
                    <h2 class="font2 grey-color">{{ $contact }}</h2>
                </td>
            </tr>
        </table>

        <div class="font1">
            <center>
                <h1 class="backSecondTitleSize">This card is non-transferrable, if found, <br> Please return to the barangay.</h1>
            </center>
        </div>

        <div class="font1">
            <br><br><br><br>
            <br><br><br><br>
            @if (!empty($signature_picture))
                <img style="position: absolute; top: 14cm; left: 12.8cm;" src="data:image/png;base64, '{{ $signature_picture }}'" alt="" height="150px" width="150px"><br>
            @endif
            <center>
                <h2 class="backSecondTitleSize">Signature</h2>
            </center>
        </div>
    </div>
</body>

</html>
