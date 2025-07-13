<div class="mb-5">
    <h2 class="h5 mb-3">About this item</h2>
    <table class="table table-bordered">
        <tbody>
            @foreach ($details as $detail)
                <tr>
                    <th class="w-25">{{ $detail->label }}</th>
                    <td>{{ $detail->value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
