<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
</head>
<body>
<div id='DivIdToPrint'>
    <?php 
        $vat = Config::get('constants.constant.vat');
        $currency = Config::get('constants.constant.currency');
    ?>
    <div style="display: flex;justify-content: space-between;flex-direction: row;width: 50%;margin: auto;padding: 40px;">
        <div style="display: flex;flex-direction: column;justify-content: space-between;">
            <div>
                <p><b>From:   </b> {{isset($client->user_nicename)?$client->user_nicename:''}} <br> Business Name: {{isset($client->user_nicename)?$client->user_nicename:''}}</p>
            </div>
            <div>
                <p><b>Bill to: </b> {{isset($freelancer->user_nicename)?$freelancer->user_nicename:'Freelancer'}}</p>
            </div>
        </div>
        <div style="display: flex;flex-direction: column;justify-content: space-between;">
            <div style="background: #EEEEEE;height: 65px;">
                <h2 align="center">Invoice</h2>
            </div>
            <div style="margin-top: 30px;">
                <table>
                    <tr style="display: flex;justify-content: space-between;flex-direction: row;width: 200px;">
                        <th>Invoice:</th>
                        <td>#{{$invoice->id}}</td>
                    </tr>
                    <tr style="display: flex;justify-content: space-between;flex-direction: row;width: 200px;">
                        <th>Amount</th>
                        <td>    </td>
                        <td>
                            @if($role=='freelancer'||$role=='admin')
                                <?php echo $currency;?>{{$invoice->amount}}
                            @else
                                <?php echo $currency;?>{{$invoice->client_pay_to_admin}}
                            @endif

                        </td>
                    </tr>
                    <tr style="display: flex;justify-content: space-between;flex-direction: row;width: 200px;">
                        <th>Date</th>
                        <td>    </td>
                        <td>{{$invoice->start_date}}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

    <div style="border: 0.5px solid silver;background:#EEEEEE;display: flex;justify-content: space-between;flex-direction: row;width: 50%;margin: auto;padding: 20px;">
        <div style="width: 80%;">Description/Demo</div>
        <div style="width: 20%;">Amount</div>
    </div>

    @if($role=='freelancer'||$role=='admin'||$role=='client')
        <div style="border: 0.5px solid silver;display: flex;justify-content: space-between;flex-direction: row;width: 50%;margin: auto;padding: 20px;">
            <div style="width: 80%;">{{$job->job_title}}</div>
            <div style="width: 20%;"><?php echo $currency;?>{{$invoice->job_bid_amount}}</div>
        </div>
    @endif
    <div style="border: 0.5px solid silver;display: flex;justify-content: space-between;flex-direction: row;width: 50%;margin: auto;padding: 20px;">
        <div style="width: 80%;">Charges</div>
        <div style="width: 20%;"><?php echo $currency;?>{{$invoice->client_pay_to_admin-$invoice->job_bid_amount}}</div>
    </div>
    <div style="border: 0.5px solid silver;display: flex;justify-content: space-between;flex-direction: row;width: 50%;margin: auto;padding: 20px;">
        <div style="width: 80%;">Total Payment</div>
        <div style="width: 20%;"><?php echo $currency;?>@if($role=='client'||$role=='admin'){{$invoice->client_pay_to_admin}}@else  {{$invoice->job_bid_amount}}   @endif</div>
    </div>


    @if($role=='admin')
        <div style="border: 0.5px solid silver;display: flex;justify-content: space-between;flex-direction: row;width: 50%;margin: auto;padding: 20px;">
            <div style="width: 80%;">Commission</div>
            <div style="width: 20%;"><?php echo $currency;?>{{$invoice->client_pay_to_admin-$invoice->amount}}</div>
        </div>
    @endif

    <div style="display: flex;justify-content: space-between;flex-direction: row;width: 50%;margin: auto;padding: 20px;">
        <div style="width: 80%;"></div>
        <div style="width: 20%;">Invoice Created via <b style="color: green;">huurr.com</b></div>
    </div>


</div>
<div style="width: 50%;margin-right: auto;margin-left: auto;margin-top: 30px;">
    <input style="width:100%;margin: auto;padding: 20px;border-radius: 10px;cursor: pointer;" type='button' id='btn' value='Print' onclick='printDiv();'>
</div>
<script>
    function printDiv()
    {

        var divToPrint=document.getElementById('DivIdToPrint');

        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

    }
</script>
</body>
</html>
