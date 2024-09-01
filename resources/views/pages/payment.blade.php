@extends('template.master')

@section('title','Home Page')

@section('content')
<h1>Hello, {{Auth::user()->name}}</h1>
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
    {{session('error')}}
</div>
@endif
<div class="d-flex justify-content-center">
    <div class="position-relative card w-50">
        <div class="card-body text-center">
            @if(Session::has('withdraw'))
                <h5 class="card-title">WITHDRAW SUCCESS!</h5>
                <p class="card-text">Thanks for your Payment. Your Balance now: {{Auth::user()->payment}}</p>
                <div class="form-text" id="basic-addon4">Click Continue to Redirect to The Dashboard</div>
                <form action="{{route('overpaid.continue')}}" method="POST">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-info w-100">CONTINUE</button>
                </form>
            @elseif(Session::has('overpaid')) 
                <h5 class="card-title">WITHDRAW</h5>
                {{-- overpaid --}}
                <p class="card-text">{{session('overpaid')}} {{Auth::user()->payment}}</p>
                <p class="card-text">Overpaid value will be your balance.</p>
                <p class="card-text">Would you like to withdraw balance?</p>
                <form action="{{route('overpaid.balance')}}" method="post" class="mt-2">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-success w-100 mb-2">Yes</button>
                </form>
                <form action="{{route('overpaid.continue')}}" method="POST">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-danger w-100">No</button>
                </form>
            @elseif(session('balance'))
                <h5 class="card-title">WITHDRAW</h5>
                <form action="{{route('overpaid.balance')}}" method="POST">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="basic-url" class="form-label">Enter the amount of balance:</label>
                        <div class="form-text" id="basic-addon4">Overpaid Value: {{Auth::user()->payment}}</div>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Rp</span>
                            <input type="number" class="form-control" name="balance" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                        </div>
                        <div class="form-text" id="basic-addon4">Enter balance amount that you want to pay here.</div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mb-2">Continue</button>
                </form>
                <form action="{{route('overpaid.continue')}}" method="post">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-danger w-100">Cancel</button>
                    <div class="form-text" id="basic-addon4">If you click "CANCEL", you will redirect to the Dashboard with overpaid's value will be your balance.</div>
                </form>
                @else 
                <h5 class="card-title">PAYMENT</h5>
                {{-- pay or underpaid --}}
                @if(Session::has('underpaid'))
                <p class="card-text text-danger">{{session('underpaid')}} {{Auth::user()->payment}}</p>
                @endif
                <p class="card-text">Amount You Have to Pay: Rp
                    <b>{{Auth::user()->payment}}</b>
                </p>
                <form action="{{ route('payment') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="basic-url" class="form-label">You have to pay before continue:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Rp</span>
                            <input type="number" class="form-control" name="pay" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                        </div>
                        <div class="form-text" id="basic-addon4">Enter amount that you want to pay here.</div>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Pay</button>
                </form>
            @endif 
        </div>
    </div>
</div>
@endsection