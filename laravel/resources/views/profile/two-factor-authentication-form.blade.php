<x-action-section>
    <x-slot name="title">
        {{ __('Change Background Gradient') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Choose up to 6 colors for your background gradient and upload an image.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Change your application\'s background gradient below.') }}
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <p>
                {{ __('Select up to six colors and click "Apply" to change the background gradient. Your preference will be saved. If you want to apply colors again after putting image, please remove image firstly') }}
            </p>
        </div>

        <!-- Gradient Color Pickers -->
        <form method="POST" action="{{ url('/background/update') }}" class="mt-4" enctype="multipart/form-data">
            @csrf

            <!-- Flexbox layout for Color Pickers and Image Input -->
            <div class="flex space-x-6">
                <!-- Color Pickers Section -->
                <div class="space-y-4 flex-auto">
                    @foreach(range(1, 6) as $i)
                        <div class="mb-4">
                            <label for="color{{$i}}" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                {{ __('Color') }} {{ $i }}
                            </label>
                            <input
                                type="color"
                                id="color{{$i}}"
                                name="color{{$i}}"
                                class="mt-1 block w-1/3 p-2 rounded border border-gray-300 dark:bg-gray-700 dark:border-gray-600"
                                value="{{ session("color{$i}", '#3e23ff') }}"
                                style="background: {{ session("color{$i}") }}"
                                onchange="updateBackgroundColor(this.id, this.value)"
                            />
                        </div>
                    @endforeach
                </div>

                <!-- Image Upload Section (right side) -->
                <div class="flex-none w-64">
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('Upload Background Image (Optional)') }}
                        </label>
                        <input
                            id="image"
                            type="file"
                            name="image"
                            accept="image/png, image/jpeg"
                            class="mt-1 block w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:border-gray-600"
                            onchange="validateFileSize(this)"
                        />
                        <div id="imagePreview" class="mt-2">
                            <!-- Image preview will go here -->
                            @if(session('background_image'))
                                <div class="relative" id="backgroundPreview">
                                    <img src="{{ asset('storage/' . session('background_image')) }}"
                                         class="mt-2 max-w-full rounded shadow" alt="Background Preview">
                                    <button id="deleteBackground"
                                            class="bg-red-500 text-white p-1 rounded-full absolute top-0 right-0">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Centered Apply Button at the Bottom -->
            <div class="mt-6 flex justify-center">
                <x-button type="submit">
                    {{ __('Apply') }}
                </x-button>
            </div>
        </form>

        <!-- Display current gradient colors -->
        <?php
        $gradient_colors = [];
        foreach (range(1, 6) as $i) {
            if (session('color' . $i)) {
                $gradient_colors[] = session('color' . $i);
            }
        }
        ?>

        @if(!empty($gradient_colors))
            <div class="mt-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Current gradient colors:') }}
                    <span class="font-semibold">
                <!-- Live Gradient Preview -->
                <div id="gradientPreview" class="mt-4 h-24 w-full rounded"
                     style="background: linear-gradient(to right, {{ implode(', ', $gradient_colors) }});">
                </div>
            </span>
                </p>
            </div>
        @endif
    </x-slot>
</x-action-section>

<script>
    function updateBackgroundColor(id, color) {
        document.getElementById(id).style.backgroundColor = color;
    }

    // Image preview
    document.getElementById('image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Create an image element and set the preview source to the file's data URL
                const imagePreview = document.getElementById('imagePreview');
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('mt-2', 'max-w-full', 'rounded', 'shadow');
                img.alt = "Background Preview";
                imagePreview.innerHTML = ''; // Clear previous preview
                imagePreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    // Color liner gradient colors
    function updateGradientPreview() {
        const colors = Array.from(document.querySelectorAll('input[type="color"]'))
            .map(input => input.value)
            .join(', ');
        document.getElementById('gradientPreview').style.background = `linear-gradient(to right, ${colors})`;
    }

    document.querySelectorAll('input[type="color"]').forEach(input => {
        input.addEventListener('change', updateGradientPreview);
    });


    // Image Delete
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButton = document.getElementById('deleteBackground');

        if (deleteButton) {
            deleteButton.addEventListener('click', function (e) {
                e.preventDefault();

                if (!confirm("Are you sure you want to delete the background image?")) {
                    return;
                }

                fetch('{{ url('/background/delete') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        const notificationMessage = document.getElementById('notification-message');
                        const successNotification = document.getElementById('notification');
                        const errorNotification = document.getElementById('error-notification');

                        if (data.success) {
                            notificationMessage.innerHTML = data.message || "Background image deleted successfully!";
                            successNotification.classList.remove("hidden");
                            errorNotification.classList.add("hidden");

                            const previewDiv = document.getElementById('backgroundPreview');
                            if (previewDiv) {
                                previewDiv.remove();
                            }

                        } else {
                            // Show error notification
                            notificationMessage.innerHTML = data.message || "Something went wrong.";
                            errorNotification.classList.remove("hidden");
                            successNotification.classList.add("hidden");
                        }

                        // Hide notification after 3 seconds
                        setTimeout(function () {
                            successNotification.classList.add("hidden");
                            errorNotification.classList.add("hidden");
                        }, 3000);
                    })
                    .catch(error => {
                        console.error("Error:", error);

                        const notificationMessage = document.getElementById('notification-message');
                        const errorNotification = document.getElementById('error-notification');

                        // Show generic error notification
                        notificationMessage.innerHTML = "An error occurred while deleting the background image.";
                        errorNotification.classList.remove("hidden");

                        // Hide notification after 3 seconds
                        setTimeout(function () {
                            errorNotification.classList.add("hidden");
                        }, 3000);
                    });
            });
        }
    });


    function validateFileSize(input) {
        const file = input.files[0];

        const maxSize = 2 * 1024 * 1024;

        if (file) {
            if (file.size > maxSize) {
                alert("The file is too large. Maximum size is 2MB .");
                input.value = "";
            }
        }
    }


</script>
