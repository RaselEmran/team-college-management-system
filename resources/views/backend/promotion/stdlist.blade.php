@foreach ($students as $element)
<tr>
	<td>
		<input type="checkbox" name="promot[]" value="{{$element->regi_no}}">
	</td>
	<td>
		<input type="text" name="regi_no[]" class="form-control" value="{{$element->regi_no}}" readonly>
	</td>
	<td>
		<input type="text" class="form-control" value="{{$element->roll_no}}" readonly>
	</td>	
	<td>
		<input type="text" class="form-control" value="{{$element->student->name}}" readonly>
	</td>
	<td>

		<input type="text" name="newrollNo[]" class="form-control" value="">
	</td>
</tr>
@endforeach