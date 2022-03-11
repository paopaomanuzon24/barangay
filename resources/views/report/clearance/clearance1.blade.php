<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>
<style>
    .center{
        text-align:center;
    }
    .arial{
        font-family :Arial, Helvetica, sans-serif;
    }
    .barangayStyle{
        font-size : large;

    }
    .barangayHeaderStyle{
        font-size : large;
        color : #6F4581;
    }
    .officeStyle{
        font-size : 24px;
        font-family :"Times New Roman";
        letter-spacing: 8px;
    }
    .backgroundImage{
         /* The image used */


        /* Full height */
        height:100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .container{
        margin-left : 7%;
        margin-right : 7%;
        font-size: small;
    }
    .gray{
        color : gray;
    }
    .toWhomStyle{
        font-size : medium;
    }
    @page { margin: 1px; }

</style>

<body>

    <div class="backgroundImage" style="background-image: url({{url('/')}}{{ $template }});">

    <div class="arial container">
        <br>
        <br>
        <br>
        <div class="center">Republic of the Philippines</div>
        <div class="center" >Metropolitan Manila</div>
        <div class="center" >City of Malabon</div>
        <div class="center barangayStyle" ><b>Barangay Longos</b></div>

        <br>
        <br>
        <div class="center officeStyle" ><b>Office of the Punong Barangay</b></div>
        <br>
        <br>
        <div class="center barangayHeaderStyle" ><b>BARANGAY CERTIFICATION</b></div>
        <br><br><br><br><br>

        <div class="toWhomStyle"><b>TO WHOM IT MAY CONCERN</b></div>
        <p style="line-height:1.5"><b>
            {{ $purpose }}
        </b>
        </p>

        <br>
        <br>

        <p>
            <b>
            This certification is issued this <u>{{ $day }}</u> of <u>{{ $month }}</u> upon request of the above party of whatever purpose it may serve hin/her.
            </b>
        </p>

        <br><br><br><br><br><br><br>

        <table style="width:100%;">
            <tr>
                <td style="text-align:center"><b>SIGNED</b></td>
                <td style="text-align:center"><b>SIGNATURE OF APPLICANT:</b></td>
            </tr>
        </table>



    </div>
</body>
</html>
