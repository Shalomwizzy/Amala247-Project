

@extends('layouts.admin')

@section('content')
    <div>
        <canvas id="orderChart" width="1200" height="400"></canvas>
    </div>

    <script>
        var ctx = document.getElementById('orderChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Total Orders (Users)',
                    data: @json($totalOrdersUsers),
                    backgroundColor: 'rgba(212, 10, 212)',
                    borderColor: 'rgba(212, 10, 212)',
                    borderWidth: 1
                }, {
                    label: 'Total Amount (Users)',
                    data: @json($totalAmountUsers),
                    backgroundColor: 'rgba(1, 148, 1)',
                    borderColor: 'rgba(1, 148, 1)',
                    borderWidth: 1
                }, {
                    label: 'Total Orders (Guests)',
                    data: @json($totalOrdersGuests),
                    backgroundColor: 'rgba(235, 235, 21)',
                    borderColor: 'rgba(235, 235, 21)',
                    borderWidth: 1
                }, {
                    label: 'Total Amount (Guests)',
                    data: @json($totalAmountGuests),
                    backgroundColor: 'rgba(7, 7, 240)',
                    borderColor: 'rgba(7, 7, 240)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <form method="GET" action="{{ route('sales.chart') }}">
        <label for="selectedMonth">Select Month: </label>
        <select name="selectedMonth" id="selectedMonth">
            @foreach($allMonths as $month)
                <option value="{{ $month }}" {{ $selectedMonth === $month ? 'selected' : '' }}>{{ $month }}</option>
            @endforeach
        </select>
        <button class="btn btn-sm btn-outline-success" type="submit">View Chart</button>
    </form>

    <!-- Navigation links for previous and next months -->
    {{-- <a href="{{ route('sales.chart', ['selectedMonth' => \Carbon\Carbon::parse($selectedMonth)->subMonth()->format('Y-m')]) }}">Previous Month</a>

    <a href="{{ route('sales.chart', ['selectedMonth' => \Carbon\Carbon::parse($selectedMonth)->addMonth()->format('Y-m')]) }}">Next Month</a> --}}

    <br>
    
    <div class="container text-center chart-container">
        <p class="user-amount">Total Amount Spent by <span class="user"> Registered Users </span>  <span class=" amount-spent"> &nbsp; :
             &#8358;{{ number_format(array_sum($totalAmountUsers->toArray()), 2) }} </span></p>


        <p class="guest-amount">Total Amount Spent by <span class="guest"> Guests Users </span> 
            <span class="amount-spent">
                &nbsp; : &#8358;{{ number_format(array_sum($totalAmountGuests->toArray()), 2) }}
            </span>
        
        </p>


        <p class="total-amount-guest-users">Total Amount Spent <span class="user"> Registered Users </span>   &nbsp; And &nbsp; <span class="guest">Guests Users in </span> 
            <span class="amount-spent">
                &nbsp;  : &#8358;{{ number_format(array_sum($totalAmountUsers->toArray()) + array_sum($totalAmountGuests->toArray()), 2) }}
        </span>
        
        </p>

        <p class="user-amount">Total Orders Placed by <span class="users-orders"> Registered Users
            </span>  
            <span class="amount-spent">
                &nbsp;   : {{ $totalOrdersUsers->sum() }}
             </span>
            
            </p>

        <p class="guest-amount">Total Orders Placed by <span class="guests-orders">Guests Users</span> 
        <span class="amount-spent">
            &nbsp; :  {{  $totalOrdersGuests->sum() }}
        </span>
        
        </p>


        <p class="total-amount-guest-users">Total Orders Placed By <span class="users-orders">Registered Users </span>  &nbsp;  And &nbsp; <span class="guests-orders">Guests Users </span> 
            <span class="amount-spent">
                &nbsp;    : {{ $totalOrdersUsers->sum() + $totalOrdersGuests->sum() }}
            </span>
        
        </p>

        @php
        $totalAmountCombined = array_sum($totalAmountUsers->toArray()) + array_sum($totalAmountGuests->toArray());
        $message = $totalAmountCombined > 50000
            ? 'Impressive performance this month! Keep reaching for the stars 👍.........'
            : 'Great effort this month! Let\'s strive for even more success next month 😊';
    @endphp

<div class="message-encourage">
    <p >{{ $message }}</p>
</div>
    <style>
        .message-encourage{
            background-color: red;
        }

        .message-encourage{
            padding: 20px;
            color: white;
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
    </div>

@endsection



