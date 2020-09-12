<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Flip Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <style>
          #output{
            background-color: white;
            min-height: 100px;
            padding: 16px;
          }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
              <div class="jumbotron">
                <h1 class="display-4">Disbursement Service</h1>
                <hr class="my-4">
                @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                      <strong>{{ $message }}</strong>
                  </div>
                @endif

                @if ($message = Session::get('error'))
                  <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                  </div>
                @endif
                <div class="row">
                  <div class="col-5">
                    <p class="lead">Send Disbursement</p>
                        <div class="form-group">
                          <label for="bank_code">Bank Code</label>
                          <input type="text" class="form-control" id="bank_code" name="bank_code" aria-describedby="bank_code">
                        </div>
                        <div class="form-group">
                          <label for="account_number">Account Number</label>
                          <input type="text" class="form-control" id="account_number" name="account_number">
                        </div>
                        <div class="form-group">
                          <label for="amount">Amount</label>
                          <input type="text" class="form-control" id="amount" name="amount">
                        </div>
                        <div class="form-group">
                          <label for="remark">Remark</label>
                          <input type="text" class="form-control" id="remark" name="remark">
                        </div>
                        <button id="buttonSend" type="button" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="col-1"></div>
                  <div class="col-5">
                    <div>
                      <p class="lead">Check Transaction Status</p>
                        <div class="form-group">
                          <label for="transaction_id">Transaction Id</label>
                          <input type="text" class="form-control" id="transaction_id" name="id" aria-describedby="bank_code">
                        </div>
                        <button id="buttonCheckStatus" type="button" class="btn btn-primary">Check Status</button>
                    </div>
                  </div>
                </div>
                <div class="row mt-4">
                  <h4>Output</h4>
                  <div id="output" class="col-12">
                    <div>
                      <span>Status:</span>
                      <span class="status"></span>
                    </div>
                    <div>
                      <span>Data: </span>
                      <span class="data"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script>
          $(function() {
            $('#buttonSend').on('click', function() {
              sendDisbursement()
            })

            $('#buttonCheckStatus').on('click', function() {
              checkStatus()
            })
            function sendDisbursement() {
              let data = {
                'bank_code' : $('#bank_code').val(),
                'amount' : $('#amount').val(),
                'account_number' : $('#account_number').val(),
                'remark' : $('#remark').val()
              };
              $('#buttonSend').prop('disabled', true)

              $.ajax({
                type: "POST",
                dataType: "json",
                data: data,
                url: "/api/send",
                success: function(response) {
                  $('#output .status').html(response.status);
                  $('#output .data').html(JSON.stringify(response.data));
                  $('#buttonSend').prop('disabled', false)
                  emptyForm()
                },
                error: function(err) {
                    $('#buttonSend').prop('disabled', false)
                    $('#output .status').text(err.status);
                    $('#output .data').text(JSON.stringify(err.statusText));
                    console.error("Error:", err);
                },
              });
            }

            function checkStatus() {
              let id =  $('#transaction_id').val();
              $('#buttonCheckStatus').prop('disabled', true);

              $.ajax({
                type: "GET",
                url: "/api/status/"+id,
                success: function(response) {
                    $('#buttonCheckStatus').prop('disabled', false)
                    $('#output .status').html(response.status);
                    $('#output .data').html(JSON.stringify(response.data));
                    emptyForm()
                },
                error: function(err) {
                    console.error("Error:", err);
                    $('#output .status').text(err.status);
                    $('#output .data').text(JSON.stringify(err.statusText));
                    $('#buttonCheckStatus').prop('disabled', false)
                },
              });
            }

            function emptyForm() { 
              $('#transaction_id').val('');
              $('#bank_code').val('');
              $('#amount').val('');
              $('#account_number').val('');
              $('#remark').val('');
            }
          })
        </script>
    </body>
</html>
