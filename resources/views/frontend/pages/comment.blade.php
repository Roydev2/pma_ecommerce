@foreach($comments as $comment)
{{-- {{dd($comments)}} --}}
@php $dep = $depth-1; @endphp
<li @if($comment->parent_id != null) style="margin-left:80px;" @endif>
    <div class="ltn__comment-item clearfix">
        <div class="ltn__commenter-img">
            @if($comment->user_info['photo'])
                <img src="{{asset('assets/users/'.$comment->user_info['photo'])}}" alt="#">
            @else
                <img src="{{asset('backend/img/avatar.png')}}" alt="">
            @endif
        </div>
        <div class="ltn__commenter-comment">
            <h6><a href="#">{{$comment->user_info['name']}}</a></h6>
            <span class="comment-date">A {{$comment->created_at->format('g: i a')}} Le {{$comment->created_at->format('M d Y')}}</span>
            <p>{{$comment->comment}}</p>
            {{-- @if($dep)
            <div class="button">
                <a href="#" class="btn btn-reply reply" data-id="{{$comment->id}}"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                <a href="" class="btn btn-reply cancel" style="display: none;" ><i class="fa fa-trash" aria-hidden="true"></i>Cancel</a>
            </div>
            @endif --}}
        </div>
    </div>
    @include('frontend.pages.comment', ['comments' => $comment->replies, 'depth' => $dep])
</li>

@endforeach
