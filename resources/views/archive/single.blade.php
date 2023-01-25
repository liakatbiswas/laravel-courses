<x-guest-layout>


    <div class="bg-gray mt-1 py-6">
        <div class="container">
            <h2 class="text-center font-bold text-2xl mb-6">{{ $title }}</h2>

            <div class="max-w-full w-full inline-flex single-feature gap-10 flex-wrap justify-between mx-auto">
                @foreach ($courses as $course)
                @include('components.course-box',['course'=>$course])
                @endforeach
            </div>

            <div class="mt-4">
                <!-- here links() if for pagination -->
                {{ $courses->links() }}
            </div>

        </div>
    </div>
</x-guest-layout>
