<div class="container mt-5">
    <div class="row">
        <div class="col-lg col-sm-12">
            <div class="mb-3 mt-3">
             @csrf
                <label for="Plan Name" class="form-label">Plan Name</label>
                <input type="text" class="form-control" id=""  name="plan_name"
                    autocomplete="off" value="{{ old('plan_name') ?? $plan->plan_name }}">
                 <small class="text-danger"> {{ $errors->first('plan_name') }}</small>
            </div>
            <div class="mb-3">
                <label for="Price" class="form-label">Price</label>
                <input type="text" class="form-control" id=""  name="price"
                    autocomplete="off" value="{{ old('price') ?? $plan->price }}">
                <small class="text-danger"> {{ $errors->first('price') }}</small>
            </div>
            <div class="mb-3 mt-3">
                <label for="Duration" class="form-label">Duration</label>
                <input type="text" class="form-control" id="" name="plan_duration"
                    autocomplete="off" value="{{ old('plan_duration') ?? $plan->plan_duration }}">
                <small class="text-danger"> {{ $errors->first('plan_duration') }}</small>
            </div>
        </div>
    </div>