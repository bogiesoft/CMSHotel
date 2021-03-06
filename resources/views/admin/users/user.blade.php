<tr @if($user->banned)  class="text-muted" title="Banned" @elseif($user->id == Auth::user()->id) class="info" @endif>
    <td class="hidden-xs hidden-sm" style="width: 5%;"><img src="/images/users/avatars/{{$user->img}}" class="img-circle" style="width: 100%"> </td>
    <td>{{$user->lastname}}</td>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->getFormattedLastLogin()}}</td>
    <td>
        <form class="form-inline" action="/dashboard/users/{{$user->id}}" method="POST">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#showUserModal{{$user->id}}">
                <i class="fa fa-fw fa-eye" aria-hidden="false" aria-label="show"></i>
            </button>

            @if($user->id !=  Auth::user()->id)
                @if(!$user->isUser())
                    <a href="/dashboard/users/{{$user->id}}/downgrade" name="id" title="Downgrade role" class="btn btn-sm btn-danger">
                        <i class="fa fa-fw fa-level-down" aria-hidden="false" aria-label="downgrade"></i>
                    </a>
                    @if(!$user->isAdmin())
                        <a href="/dashboard/users/{{$user->id}}/upgrade" title="Upgrade role" class="btn btn-sm btn-info">
                            <i class="fa fa-fw fa-level-up" aria-hidden="false" aria-label="upgrade"></i>
                        </a>
                    @endif
                @else
                    <a href="/dashboard/users/{{$user->id}}/ban"title="Ban user" class="btn btn-sm btn-danger ban-user">
                        <i class="fa fa-fw fa-ban" aria-hidden="true"></i>
                    </a>
                @endif
            @endif
        </form>
    </td>
</tr>
@include('modals.users.show-user-modal')