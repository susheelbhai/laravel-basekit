<div class="mt-10 border-t border-border pt-8">
    <h4 class="mb-4 text-lg font-semibold">Leave a Reply</h4>
    <form action="{{ route('blog.comment', $data['id']) }}" method="POST" class="space-y-4">
        @csrf
        @guest('web')
            <div class="grid gap-4 md:grid-cols-2">
                <input type="text" name="name" placeholder="Your Name" class="rounded-div border border-border bg-background px-3 py-2 text-sm" />
                <input type="tel" name="phone" placeholder="Your Phone" class="rounded-div border border-border bg-background px-3 py-2 text-sm" />
            </div>
            <input type="email" name="email" placeholder="Email" class="w-full rounded-div border border-border bg-background px-3 py-2 text-sm" />
        @else
            <div class="flex items-center gap-2 text-sm">
                <img src="{{ asset(Auth::user()->profile_pic) }}" alt="" class="h-12 w-12 rounded-full object-cover" />
                <span>{{ Auth::user()->name }}</span>
            </div>
        @endguest
        <textarea name="comment" rows="4" placeholder="Your comment" class="w-full rounded-div border border-border bg-background px-3 py-2 text-sm"></textarea>
        <button type="submit" class="rounded-div bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground hover:bg-primary/90">
            Submit Comment
        </button>
    </form>
</div>

@if (isset($comments) && $comments->count())
    <div class="mt-8 space-y-4">
        @foreach ($comments as $comment)
            <div class="flex gap-3 rounded-div border border-border bg-muted/40 p-4">
                <img src="{{ asset($comment->user->profile_pic) }}" alt="" class="h-10 w-10 shrink-0 rounded-full object-cover" />
                <div>
                    <p class="font-medium">{{ $comment->user->name }}</p>
                    <p class="text-sm text-muted-foreground">{{ $comment->message }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endif
