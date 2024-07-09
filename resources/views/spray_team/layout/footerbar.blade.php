<div id="footer-bar" class="footer-bar-5">
  <a href="{{ route('spray_team.dashboard') }}" class="{{isset($menu) && $menu == 'dashboard' ? 'active-nav' : ''}}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings" data-feather-line="1" data-feather-size="21" data-feather-color="brown-dark" data-feather-bg="brown-fade-light" style="stroke-width: 1; width: 21px; height: 21px;"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
    <span>Dashboard</span>
  </a>
  @php
    $_user_wards = Auth::guard('customer')->user()->ward;
    $_user_wards = explode(',',$_user_wards);
    $task_ids = DB::table('pick')->where(['q1'=>'yes', 'status'=>1])->whereIn('ward',$_user_wards)
                  ->where(function ($query) {
                    $query->where('source_reduction', '=', null)
                    ->orWhere('source_reduction', '=', 'Not Done');
                  })->pluck('id')->toArray();
    $_pick_ids = DB::table('dump')->whereIn('pid', $task_ids)->pluck('pid')->toArray();
    $task_count = count(array_diff($task_ids, $_pick_ids));
  @endphp
  <a href="{{ route('spray_team.task_list')}}" class="{{isset($menu) && $menu == 'my_task' ? 'active-nav' : ''}}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe" data-feather-line="1" data-feather-size="21" data-feather-color="dark-dark" data-feather-bg="gray-fade-light" style="stroke-width: 1; width: 21px; height: 21px;"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
    <span>My Task</span>
    @if($task_count > 0)
    <span style="background:red;opacity:1;border-radius:20px;position:absolute;top:-6px;left:60%;color:white;padding:0 9px;">{{$task_count}}</span>
    @endif
  </a>
  <a href="{{ route('spray_team.history_list')}}" class="{{isset($menu) && $menu == 'history' ? 'active-nav' : ''}}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe" data-feather-line="1" data-feather-size="21" data-feather-color="dark-dark" data-feather-bg="gray-fade-light" style="stroke-width: 1; width: 21px; height: 21px;"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
    <span>History</span>
  </a>
</div>