
{{-- For staff --}}
<li class="{{ Request::is('finance/staff/history*') ? 'current-page' : '' }}">
<a href="{{route('staff_4_history')}}">
  <i class="icofont-history pr-2" style="font-size: 20px"></i>
Order History
</a>
</li>

{{-- For Admin --}}
<li class="{{ Request::is('finance/admin/history*') ? 'current-page' : '' }}">
<a href="{{route('admin_5_history')}}">
  <i class="icofont-history pr-2" style="font-size: 20px"></i>
Order History
</a>
</li>