<h3 class="text-center text-dark text-uppercase">{{Helper::helper_number_format($product['price'])}}</h3>

@if (!empty($product['products_installments']))
  <div class="table">
    <table class="table table-responsive table-bordered table-hover">
      <thead>
        <tr>
          <th>Tenor</th>
          <th>Angsuran</th>
          <th>Total Down Payment (TDP)</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($product['products_installments'] as $key => $item)
          <tr>
            <td width="30%" id="tenor_{{$key}}">{{$item['tenor']['tenor'].' '.$item['tenor']['unit']}}</td>
            <td width="30%" id="price_installment_{{$key}}">{{Helper::helper_number_format($item['price_installment'])}}</td>
            <td width="30%" id="tdp_{{$key}}">{{Helper::helper_number_format($item['tdp'])}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@else
  <h3>Cicilan / Kredit tidak tersedia</h3>
@endif