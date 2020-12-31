<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="codeno">Code No <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		<input type="text" id="codeno" name="codeno" class="form-control @error('codeno') is-invalid @enderror" value="@error('codeno') {{old('codeno')}} @else {{$warehouse->codeno}} @enderror">
		@error('codeno')
			<div class="text text-danger">{{$message}}</div>
		@enderror
	</div>
</div>