<div id="user-search-table" class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>{{ __('labels.backend.access.users.table.name') }}</th>
            <th>{{ __('labels.backend.access.users.table.email') }}</th>
            <th>{{ __('labels.backend.access.users.table.mobile') }}</th>
            <th>{{ __('labels.backend.access.users.table.confirmed') }}</th>
            <th>{{ __('labels.backend.access.users.table.roles') }}</th>
            <th>{{ __('labels.backend.access.users.table.other_permissions') }}</th>
            <th>{{ __('labels.backend.access.users.table.social') }}</th>
            <th>{{ __('labels.backend.access.users.table.last_updated') }}</th>
            <th>{{ __('labels.general.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @if(count($users) > 0)
            @foreach ($users as $user)
                <tr>
                    <td>
                    @if($user->name)
                        {{ $user->name }}
                    @else
                       {{ $user->first_name }} {{ $user->last_name }}
                    @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobileNumber }}</td>
                    <td>{!! $user->confirmed_label !!}</td>
                    <td>{!! $user->roles_label !!}</td>
                    <td>{!! $user->permissions_label !!}</td>
                    <td>{!! $user->social_buttons !!}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                    <td>{!! $user->action_buttons !!}</td>
                </tr>
            @endforeach
        @else
            <tr><td class="text-center" colspan="8">No User Found</td></tr>   
        @endif
        </tbody>
    </table>
</div>