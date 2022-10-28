<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control">
        <option value="">-- Select --</option>
        @foreach($options as $key=>$val)
            <option value="{{$key}}">{{$val}}</option>
        @endforeach
    </select>
</div>
