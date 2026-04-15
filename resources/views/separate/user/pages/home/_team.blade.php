@if(!empty($team) && count($team) > 0)
    <section id="team" class="bg-background py-20 md:py-28">
        <x-container class="px-4 text-center">
            <div class="mb-10">
                <p class="text-sm font-semibold tracking-wider text-primary uppercase">Our Team</p>
                <h2 class="mt-2 text-3xl font-bold">Meet Our Experts</h2>
            </div>

            <div class="grid gap-8 md:grid-cols-4">
                @foreach($team as $member)
                    @php
                        $memberImage = data_get($member, 'image_converted.small');
                        $memberImageUrl = $memberImage
                            ? (\Illuminate\Support\Str::startsWith($memberImage, ['http://', 'https://', '//']) ? $memberImage : asset($memberImage))
                            : null;
                    @endphp
                    <div class="rounded-div bg-background2 p-6">
                        <img
                            src="{{ $memberImageUrl }}"
                            alt="{{ $member->name }}"
                            class="mx-auto mb-4 h-32 w-32 rounded-full object-cover"
                        />
                        <h3 class="text-xl font-semibold">{{ $member->name }}</h3>
                        <p class="text-muted-foreground">{{ $member->designation }}</p>
                    </div>
                @endforeach
            </div>
        </x-container>
    </section>
@endif