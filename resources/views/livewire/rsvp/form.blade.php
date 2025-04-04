<div>
    @if ($stage === \App\Enums\RsvpStage::FORM->value)
        <form class="flex flex-col gap-4 rounded">
            <div class="flex flex-col gap-5 mt-8 ">
                <h2 class="flex items-center gap-1 text-3xl">Can you attend as a day guest?</h2>
{{--                <div class="flex flex-col items-center gap-4">--}}
{{--                    <x-button :active="$attending" wire:click.prevent="setAttending(true)" text="Yes!" />--}}
{{--                    <x-button :active="$attending === false" wire:click.prevent="setAttending(false)" text="No" />--}}
{{--                </div>--}}
                <div class="flex gap-6">
                <x-radio-button model="attending" value="yes">Yes</x-radio-button>
                <x-radio-button model="attending" value="no">No</x-radio-button>
                </div>
                @if ($attending)
                    <p>Woohoo! We can't wait to see you there! 🥳</p>
                @endif
            </div>

            @if ($attending)
                <div class="flex flex-col">
                    <h2 class="mt-8 mb-4 text-3xl">
                        Who's attending?
                    </h2>
                    <ul class="flex flex-col gap-4">
                        @foreach ($rsvp->guests as $index => $guest)
                            <li><x-toggle :id="$guest->id" model="attending_guests" :text="$guest->name" /></li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    @if (! empty($attending_guests))
                        <h2 class="mt-8 flex items-center gap-1 text-3xl">Any dietary requirements?</h2>
                        <div class="flex gap-6">
                            <x-radio-button model="has_dietary_requirements" value="yes">Yes</x-radio-button>
                            <x-radio-button model="has_dietary_requirements" value="no">No</x-radio-button>
                        </div>
                    @endif

                    @if (! empty($attending_guests) && $has_dietary_requirements)
                        @foreach ($rsvp->guests as $index => $guest)
                            @if (in_array($guest->id, $attending_guests))
                                <x-rsvp.dietary-requirements
                                    model="dietary_requirements.{{$guest->id}}"
                                    :guest="$guest"
                                />
                            @endif
                        @endforeach
                    @endif
                </div>
            @elseif ($attending !== null)
                <label for="message" class="mb-2">
                    We're sorry you can't make it, use the box below to leave a message.
                </label>
                <textarea
                    id="message"
                    rows="4"
                    class="placeholder-dark-green border-dark-green block w-full rounded-lg border bg-white p-2.5 text-sm"
                    placeholder="Write your thoughts here..."
                ></textarea>
            @endif
            @if ($attending === false || ($attending === true && $has_dietary_requirements !== null))
                <div class="flex justify-end mt-8">
                    <x-button wire:click.prevent="setStage('{{\App\Enums\RsvpStage::CONFIRM->value}}')" text="Next" />
                </div>
            @endif
        </form>
    @endif

    @if ($stage === \App\Enums\RsvpStage::CONFIRM->value)
        <div class="py-6">
            <h2 class="pb-2 text-3xl uppercase">Confirmation</h2>
            <div class="mb-12 flex flex-col gap-6 rounded py-4">
                @if ($rsvp->guests->whereIn('id', $attending_guests)->isNotEmpty())
                    <div>
                        <h3 class="mb-2 text-2xl">Attending</h3>
                        <ul class="flex flex-col gap-2">
                            @foreach ($rsvp->guests->whereIn('id', $attending_guests) as $guest)
                                <li class="flex flex-col">
                                    <h4 class="text-xl">{{ $guest->name }}</h4>

                                    @if ($has_dietary_requirements)
                                        @php
                                            $requirements = collect($dietary_requirements[$guest->id] ?? [])
                                                ->filter(fn ($value) => $value == true)
                                                ->implode(fn ($value, $index) => $index, ', ');
                                        @endphp

                                        <span>
                                            {{ $requirements ?: 'None' }}
                                        </span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($rsvp->guests->whereNotIn('id', $attending_guests)->isNotEmpty())
                    <div>
                        <h3 class="mb-2 text-xl">Not Attending</h3>
                        <ul class="flex flex-col gap-2">
                            @foreach ($rsvp->guests->whereNotIn('id', $attending_guests) as $guest)
                                <li class="flex flex-col">
                                    <h4 class="text-lg">{{ $guest->name }}</h4>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex flex-col items-end gap-4 md:flex-row md:justify-between">
                    <x-button wire:click.prevent="setStage('{{\App\Enums\RsvpStage::FORM->value}}')" text="Back" />

                    <x-button
                        wire:click.prevent="confirm()"
                        text="Confirm"
                        @click="if ({{(int) $rsvp->guests->whereIn('id', $attending_guests)->isNotEmpty()}}) {
                            jsConfetti.addConfetti();
                            jsConfetti.addConfetti({emojis: ['🧡', '💍', '🎉', '🪩']});
                        }"
                    />
                </div>
            </div>
        </div>
    @endif
</div>
