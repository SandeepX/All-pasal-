
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bill</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    .bill {
      display: flex;
      margin: 40px 0;
      justify-content: center;
    }
    .bill-body {
      width: 600px;
    }
    .intro {
      text-align: center;
      font-weight: bold;
    }
    .company-title {
      font-size: 24px;
    }
    .intro-body {
      display: flex;
      margin-top: 12px;
      justify-content: space-between;
    }
    .invoice {
      display: flex;
      margin-top: 12px;
      justify-content: flex-end;
    }
    .payment-method {
      margin-top: 12px;
    }
    .bill-table {
      margin-top: 12px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th {
      padding: 8px;
      text-align: left;
    }
    td, th {
      border: 1px solid black;
    }
    td {
      padding: 8px;
    }
    .bill-footer {
      font-size: 14px;
      display: flex;
      margin-top: 28px;
      justify-content: space-between;
    }
  </style>
</head>
<body>
  <div class="bill">
    <div class="bill-body">
      <div class="intro">
        <div>Tax Invoice</div>
        <div class="company-title">ALL PASAL PUBLIC LIMITED</div>
        <div>New Baneshwor-10, Nepal</div>
        <div>Warehouse, Budhanilkantha-10, Kathmandu</div>
      </div>

      <div>
       <a href="{{route('bill')}}"> <button  type="button" class="btn btn-success">Generate Bill</button></a>
      </div>

      <div class="intro-body">
        <div>Vat No. 609762431</div>
        <div>Contact No: 984003071</div>
      </div>
      <div class="intro-body">
        <div>Name: Chain Store</div>
        <div>Date of bill issue: 984003071</div>
      </div>
      <div class="intro-body">
        <div>Address: Hatiya, Hetauda</div>
        <div>Transaction Date: {{ date('Y/m/d ') }}</div>
      </div>
      <div class="intro-body">
        <div>Customer's PAN No: 614120523</div>
      </div>
      <div class="invoice">
        <div>Invoice: 001</div>
      </div>
      <div class="payment-method">
        Payment Method: Cash/Credit/Cheque
      </div>

    

      <div class="bill-table">
        <table>
          <tr>
            <th  style="width: 50px; text-align: center;">S.N.</th>
            <th  style="width: 305px; text-align: center;">Particulars</th>
            <th  style="width: 50px;">Qty.</th>
            <th  style="width: 80px;">Rate</th>
            <th  style="width: 120px;" >Amount (Rs.)</th>
          </tr>
          
         

          
          @if((isset($detail)) && count($detail)>0) 
            <?php $total = 0 ?>
            @foreach($detail as $data)
            @php( $subtotal = ($data->quantity) * ($data->unit_rate))
            @php ($total += $subtotal)
           
            
             
            <tr>
              <td align="center">{{$data->store_order_detail_code}}</td>
              <td>{{$data->product->product_name}}</td>
              <td>{{$data->quantity}}</td>
              <td>{{number_format($data->unit_rate)}}</td>
              <td>{{number_format($subtotal)}}</td>

              
              
             
            </tr>
            
            @endforeach
          @endif
          
          <tr>
            <td colspan="2" rowspan="5">
              <span style="font-weight: bold;">In words:</span>
              
              
              
              Eighty six thousand nine hundred fifty eight and sixty paisa only.
            </td>
            <td colspan="2" align="right">
              Sub Total:
            </td>
            <td>{{number_format($total)}}</td>
            
          </tr>
          <tr>
            <td colspan="2" align="right">
              Discount:
            </td>
            <td></td>
            
          </tr>
          <tr>
            <td colspan="2" align="right">
              Taxable Amount:
            </td>
            <td></td>
            
          </tr>
          <tr>
            <td colspan="2" align="right">
              % VAT:
            </td>
            <td></td>
            
          </tr>
          <tr>
            <td colspan="2" align="right">
              Grand Total:
            </td>
            <td>{{number_format($total)}}</td>
            
          </tr>
        </table>
      </div>
      <div class="bill-footer">
        <div>
          <div>_____________</div>
          <div style="margin-top: 8px;">Customer's Sign</div>
        </div>
        <div>
          <div>__________</div>
          <div style="margin-top: 8px;">Prepared By</div>
        </div>
        <div>
          <div>___________________________</div>
          <div style="margin-top: 8px;">ALL PASAL PUBLIC LIMITED</div>
        </div>
      </div>
    </div>
  </div>

  
</body>
</html>
