<table class="table">
	<tbody>
		@php
			$total =0;
		@endphp
		@forelse ($feesetup as $element)
		<tr>
			<td>
				<input type="text" name="type[]" class="form-control" value="{{$element->type}}" readonly>
				<input type="hidden" name="feeid[]" class="form-control" value="{{$element->id}}" readonly>
				<input type="hidden" name="origin_fee[]" class="form-control" value="{{$element->fee}}" readonly>
			</td>
			<td>
				<input type="text" name="title[]" class="form-control" value="{{$element->title}}" readonly>
			</td>
			<td>
				<input type="text" name="fee[]" class="form-control fee" value="{{$element->fee}}">
			</td>
			<td>
				<input type="text" name="Latefee[]" class="form-control" value="{{$element->Latefee}}">
			</td>

		</tr>
		@php
			$total+=$element->fee;
		@endphp
		@empty
		<tr>
			<td colspan="4"> No fee Found For this class</td>

		</tr>
		@endforelse
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" class="text-right">Total</td>
			<td><input type="text" name="fee_total" class="form-control total" value="{{$total}}" readonly></td>
			<td></td>
		</tr>
	</tfoot>
</table>