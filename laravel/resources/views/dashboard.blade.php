<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight select-none">
            {{ __('Smart English') }}
        </h2>
    </x-slot>

    <div class="py-12 select-none">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 pt-4 bg-white dark:bg-gray-900 p-6">
                    <div>
                        <!-- Main Button -->
                        <button id="multiLevelDropdownButton" data-dropdown-toggle="dropdownAction"
                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                type="button">
                            <span id="status_text">Sort by Status</span>
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>

                        <!-- First-Level Dropdown -->
                        <div id="dropdownAction"
                             class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="multiLevelDropdownButton">
                                <li id="sortAll" value="all"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    All
                                </li>
                                <li>
                                    <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                                            data-dropdown-placement="right-start"
                                            class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Sort by Groups
                                        <svg class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="m1 9 4-4-4-4"/>
                                        </svg>
                                    </button>
                                    <div id="doubleDropdown"
                                         class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li id="sortEnglish" value="English"
                                                class="block  px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                                English
                                            </li>
                                            <li>
                                            <li id="sortIt" value="It"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                                It
                                            </li>
                                            <li id="sortRussian" value="Russian"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                                Russian
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <!-- Nested Dropdown: Sort by Group -->
                                <li>
                                    <button id="groupDropdownButton" data-dropdown-toggle="groupDropdown"
                                            data-dropdown-placement="right-start"
                                            class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Sort by Status
                                        <svg class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="m1 9 4-4-4-4"/>
                                        </svg>
                                    </button>
                                    <div id="groupDropdown"
                                         class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li id="sortCalled" value="Called"
                                                class="block  px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                                Called
                                            </li>
                                            <li>
                                            <li id="sortUncalled" value="Uncalled"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                                UnCalled
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search-users"
                               class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Search for users">
                    </div>
                </div>


                <!-- Add an ID to the table for targeting -->
                <div id="table-container" class="overflow-hidden max-h-[470px]">
                    <table id="users-table"
                           class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">ID</th>
                            <th scope="col" class="px-6 py-3">Full Name</th>
                            <th scope="col" class="px-6 py-3">Group</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Gender</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody id="user-data">
                        <!-- Dynamic rows will be added here -->

                        </tbody>
                    </table>
                </div>
                <div id="user_found" class="flex justify-center p-6 hidden">No Users Found</div>

                <!-- Pagination buttons -->


            </div>

            <div id="pagination" class="btn-pagination mt-4 space-x-2 flex justify-center">
            </div>

    {{--    Open Modal--}}

    <!-- Modal Structure -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
         class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%)] max-h-full z-50">
        <div class="relative p-4 w-full max-w-md max-h-full  rounded-lg shadow-lg">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Students Info
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal" id="closeModalBtn">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <!-- Full Name Field -->
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                                name</label>
                            <input type="text" name="full_name" id="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Type your full name" required="" maxlength="30">
                        </div>

                        <!-- Gender Field (Radio Buttons) -->
                        <div class="col-span-2 sm:col-span-1">
                            <h3 class="flex justify-center mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Choose your gender</h3>
                            <div class="gender center">
                                <div class="maleRadio">
                                    <input type="radio" name="myGender" value="Male" class="male hidden"
                                           id="masculino"/>
                                    <label for="masculino"></label>
                                </div>
                                <div class="femaleRadio">
                                    <input type="radio" name="myGender" value="Female" class="female hidden"
                                           id="femenino"/>
                                    <label for="femenino"></label>
                                </div>
                            </div>
                        </div>

                        <!-- Group Field (Select Dropdown) -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="group" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edit
                                Group</label>
                            <select id="group" name="group"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Edit a Group</option>

                            </select>

                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edit
                                Status</label>
                            <select id="status" name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="Called">Called</option>
                                <option value="Uncalled">Uncalled</option>

                            </select>
                        </div>

                        <div class="col-span-2">
                            <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                                Comment</label>
                            <textarea id="comment" name="comment" rows="4"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                      placeholder="Write User comment here"></textarea>
                        </div>
                    </div>

                    <button data-bs-toggle="modal" type="submit" id="update-btn"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>

            <div class="flex justify-center items-center" id="pagination-controls"></div>
        </div>
    </div>
</x-app-layout>
<script>


    let user_id;
    const modal = document.getElementById("crud-modal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    let currentPage;
    let searching;


    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", function () {
            modal.classList.add("hidden");
        });
    }

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });

    function Fetch() {
        fetch(`/users`)
            .then(response => response.json())
            .then(users => {

                let usersTableBody = document.querySelector('table tbody');
                usersTableBody.innerHTML = '';

                users.forEach(user => {
                    let row = document.createElement('tr');
                    row.classList.add('bg-white', 'border-b', 'dark:bg-gray-800', 'dark:border-gray-700', 'hover:bg-gray-50', 'dark:hover:bg-gray-600', 'capitalize');

                    let statusCell = '';
                    if (user.status === 'Called') {
                        statusCell = `<td class="px-6 py-4"><div class="flex items-center"><div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Called</div></td>`;
                    } else {
                        statusCell = `<td class="px-6 py-4"><div class="flex items-center"><div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Uncalled</div></td>`;
                    }

                    row.innerHTML = `
                    <td class="w-4 p-4">${user.id}</td>
                    <td class="px-6 py-4">${user.full_name}</td>
                    <td class="px-6 py-4">${user.group}</td>
                    ${statusCell}
                    <td class="px-6 py-4">${user.gender}</td>
                    <td class="px-6 py-4">
                        <button onclick="openModal(${user.id}, '${user.full_name}', '${user.group}', '${user.gender}', '${user.comment}' ,'${user.status}')" class="text-blue-600 hover:text-blue-800">Edit</button>
                    </td>
                `;

                    usersTableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        Fetch();
    });


    function openModal(id, full_name, group, gender, comment, status) {
        modal.classList.remove("hidden");
        user_id = id;
        document.getElementById("name").value = full_name;

        const genderRadio = document.querySelector("input[name='myGender'][value='" + gender.charAt(0).toUpperCase() + gender.slice(1).toLowerCase() + "']");
        if (genderRadio) {
            genderRadio.checked = true;
        } else {
            console.warn("Gender radio button not found for value:", gender);
            document.querySelector("input[name='myGender'][value='Male']").checked = true;
        }

        const groupSelect = document.getElementById("group");
        if (groupSelect) {


            const option = Array.from(groupSelect.options).find(opt => opt.value === group);

            if (option) {
                option.selected = true;

            } else {
                groupSelect.value = "English";
                console.warn("Group option not found for value:", group);
            }
        }

        const comments = document.getElementById('comment');
        if (comment !== null) {
            comments.value = comment;
        } else if (comments.value == null) {
            comments.innerHTML = ''
        }

        // Set status
        const statusSelect = document.getElementById("status");
        if (statusSelect) {
            statusSelect.value = status;
        } else {
            console.warn("Status select element not found.");
        }
    }

    let status = 'all'

    function groups() {
        fetch('/get/groups')
            .then(response => response.json())
            .then(data => {


                let selectElement = document.querySelector('select');
                selectElement.innerHTML = '';
                data.forEach(group => {

                    let option = document.createElement('option');
                    option.value = group;
                    option.textContent = group;
                    selectElement.appendChild(option);
                });
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        groups()
    })


    document.addEventListener('DOMContentLoaded', function () {

        fetch('/get/groups')
            .then(response => response.json())
            .then(data => {


                let selectElement = document.querySelector('select');
                selectElement.innerHTML = '';
                data.forEach(group => {

                    let option = document.createElement('option');
                    option.value = group;
                    option.textContent = group;
                    selectElement.appendChild(option);
                });
            });
    })


    let pagination = document.getElementById('pagination');
    let is_Sorting = false;
    let is_status = false
    let status_name;
    let groups_name
    let called_count = 0;
    let uncalled_count = 0;
    let total_count = 0;



    // SORT


    document.addEventListener('DOMContentLoaded', function () {
        is_Sorting = false;

        document.getElementById('sortAll').addEventListener('click', function () {
            status_name = ''
            filterRows('all');
            is_Sorting = false;
            groups_name = ''
            updateStatus(status_name)
            document.getElementById('table-search-users').placeholder = 'Search the User' + status_name
            document.getElementById('status_text').innerHTML = document.getElementById('status_text').innerHTML.replace(/Sorted by Called/g, 'Sort by Status').replace(/Sorted by Uncalled/g, 'Sort by Status');
        });

        document.getElementById('sortCalled').addEventListener('click', function () {
            status_name = 'called'
            filterRows('called');
            is_Sorting = true;
            groups_name = ''
            updateStatus(status_name)
            document.getElementById('table-search-users').placeholder = 'Search the ' + status_name
            document.getElementById('status_text').innerHTML = document.getElementById('status_text').innerHTML.replace(/Sort by Status/g, 'Sorted by Called').replace(/Sorted by Uncalled/g, 'Sorted by Called');
        });

        document.getElementById('sortUncalled').addEventListener('click', function () {
            status_name = 'uncalled'
            filterRows('uncalled');
            is_Sorting = true;
            groups_name = ''
            updateStatus(status_name)
            document.getElementById('table-search-users').placeholder = 'Search the ' + status_name
            document.getElementById('status_text').innerHTML = document.getElementById('status_text').innerHTML.replace(/Sort by Status/g, 'Sorted by Uncalled').replace(/Sorted by Called/g, 'Sorted by Uncalled');
        });

        document.getElementById('sortRussian').addEventListener('click', function () {
            groups_name = 'russian'
            filterRows('Russian');
            status_name = ''
            is_Sorting = true;
            updateStatus(groups_name);
            document.getElementById('table-search-users').placeholder = `Search the ` + groups_name + ' groups'
            document.getElementById('status_text').innerHTML = document.getElementById('status_text').innerHTML.replace(/Sort by Status/g, 'Sorted by Called').replace(/Sorted by Uncalled/g, 'Sorted by Called');
        });

        document.getElementById('sortIt').addEventListener('click', function () {
            groups_name = 'it'
            filterRows('It');
            is_Sorting = true;
            status_name = ''
            updateStatus(groups_name)
            document.getElementById('table-search-users').placeholder = `Search the ` + groups_name + ' groups'
            document.getElementById('status_text').innerHTML = document.getElementById('status_text').innerHTML.replace(/Sort by Status/g, 'Sorted by Uncalled').replace(/Sorted by Called/g, 'Sorted by Uncalled');
        });


        document.getElementById('sortEnglish').addEventListener('click', function () {
            groups_name = 'english'
            filterRows('English');
            is_Sorting = true;
            status_name = ''
            updateStatus(groups_name)
            document.getElementById('table-search-users').placeholder = `Search the ` + groups_name + ' groups'
            document.getElementById('status_text').innerHTML = document.getElementById('status_text').innerHTML.replace(/Sort by Status/g, 'Sorted by Called').replace(/Sorted by Uncalled/g, 'Sorted by Called');
        });


        function filterRows(status) {
            let matchFound = false;

            document.querySelectorAll('#users-table tbody tr').forEach(row => {
                const statusText = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                const groupText = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();

                if (status === 'all') {
                    row.style.display = '';
                    matchFound = true;
                    total_count++
                    is_status = false
                } else if (status === 'called' && statusText === 'called') {
                    row.style.display = '';
                    matchFound = true;
                    called_count++
                    is_status = true
                } else if (status === 'uncalled' && statusText === 'uncalled') {
                    row.style.display = '';
                    matchFound = true;
                    uncalled_count++
                    is_status = true
                } else if (status === 'English' && groupText === 'english') {
                    row.style.display = '';
                    matchFound = true;
                    called_count++
                    is_status = true
                } else if (status === 'It' && groupText === 'it') {
                    row.style.display = '';
                    matchFound = true;
                    uncalled_count++
                    is_status = true
                } else if (status === 'Russian' && groupText === 'russian') {
                    row.style.display = '';
                    matchFound = true;
                    uncalled_count++
                    is_status = true
                } else {
                    row.style.display = 'none';
                }
            });

            if (!matchFound) {
                document.querySelector("table").classList.add('none');
                document.getElementById('user_found').classList.remove('hidden');
            } else {
                document.querySelector("table").classList.remove('none');
                document.getElementById('user_found').classList.add('hidden');
            }
        }
    });


    // SEARCH


    document.getElementById('table-search-users').addEventListener('input', function (e) {
        searching = true
        const searchTerm = e.target.value.toLowerCase();
        const table = document.querySelector("table");
        const userFound = document.getElementById('user_found');

        let matchFound = false;
        is_Sorting = searchTerm !== '';
        currentPage = 1;
        fetchPaginationData()

        document.querySelectorAll('#users-table tbody tr').forEach(row => {
            let fullName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const statusText = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
            const groupText = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();

            // console.log(groupText)

            if (fullName.includes(searchTerm) && (!is_status || statusText === status_name || groupText === groups_name)) {
                console.log(groupText, groups_name)
                row.style.display = '';
                matchFound = true;
            } else {
                row.style.display = 'none';
            }
        });

        if (!matchFound && is_Sorting) {
            table.classList.add('hidden');
            userFound.classList.remove('hidden');
        } else {
            table.classList.remove('hidden');
            userFound.classList.add('hidden');
            searching = false
        }

        checker();
    });


    // EDIT MENU


    document.querySelector('#update-btn').addEventListener('click', function () {
        const fullNameElement = document.getElementById('name');
        const genderElement = document.querySelector("input[name='myGender']:checked");
        const groupElement = document.getElementById('group');
        const statusElement = document.getElementById('status');
        const commentElement = document.getElementById('comment')


        if (!fullNameElement || !genderElement || !groupElement || !statusElement) {
            console.error("One or more form elements are missing.");
            return;
        }

        const data = {
            full_name: fullNameElement.value,
            gender: genderElement.value,
            group: groupElement.value,
            status: statusElement.value,
            comment: commentElement.value
        };


        $.ajax({
            type: "PUT",
            url: `/users/${user_id}`,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: data,
            success: function (data) {

                const messageContainer = document.getElementById('notification-message');
                messageContainer.innerHTML = data.message;

                document.getElementById('notification').classList.remove("hidden");


                setTimeout(function () {
                    document.getElementById('notification').classList.add("hidden");
                }, 3000);

                modal.classList.add("hidden");
                groups();
                Fetch();
                document.getElementById('table-search-users').value = '';
            },
            error: function (xhr, error, message) {
                const messageContainer = document.getElementById('error-message');


                const errorMessage = xhr.responseJSON?.message || 'An error occurred while updating the user.';

                console.error(xhr.xhr?.error);

                messageContainer.innerHTML = errorMessage;
                document.getElementById('error-notification').classList.remove("hidden");

                setTimeout(function () {
                    document.getElementById('error-notification').classList.add("hidden");
                }, 3000);

                // Hide modal
                modal.classList.add("hidden");
            }
        });
    });

    // Pagination's


    function fetchPaginationData() {
        $.ajax({
            type: "GET",
            url: `/get/pagination`,
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
            },
            success: function (response) {

                let currentPage = response.current_page;
                let totalPages = response.total_pages;
                let called_count = response.called_count;
                let uncalled_count = response.uncalled_count;
                let it_count = response.it_count;
                let eng_count = response.eng_count;
                let rus_count = response.rus_count;
                let endPage;

                if (!currentPage || !totalPages) {
                    console.error('Pagination data is missing or incorrect.');
                    return;
                }

                if (status_name === 'called') {
                    totalPages = called_count;
                    console.log('status name', status_name);
                } else if (status_name === 'uncalled') {
                    totalPages = uncalled_count;
                    console.log(status_name, 'count : ', uncalled_count)

                } else if (groups_name === 'it') {
                    totalPages = it_count;
                    console.log(status_name, 'count : ', it_count)

                } else if (groups_name === 'russian') {
                    totalPages = rus_count;
                    console.log(status_name, 'count : ', rus_count)

                } else if (groups_name === 'english') {
                    totalPages = eng_count;
                    console.log(status_name, 'count : ', eng_count)

                } else {
                    console.log('status name', status_name);
                }

                let usersTableBody = document.querySelector('#pagination');
                usersTableBody.innerHTML = '';

                function addButton(pageNumber, isCurrent) {
                    let button = document.createElement('button');
                    button.classList.add('px-4', 'py-2', 'rounded', 'mr-2');
                    button.innerHTML = pageNumber;

                    if (isCurrent) {
                        button.classList.add('bg-blue-700', 'text-white');
                        button.disabled = true;
                    } else {
                        button.classList.add('bg-blue-500', 'text-white');
                        button.onclick = function () {
                            fetchPage(pageNumber);
                        };
                    }

                    usersTableBody.appendChild(button);
                }

                function fetchPage(pageNumber) {
                    scrollToPage(pageNumber);
                    currentPage = pageNumber;
                    renderPagination();
                }

                // Function to handle scrolling to a page
                function scrollToPage(pageNumber) {
                    const tableContainer = document.getElementById('table-container');
                    const scrollAmount = 475 * (pageNumber - 1); // Adjust as needed
                    tableContainer.scrollTo({
                        top: scrollAmount,
                        behavior: 'smooth'
                    });
                }

                function renderPagination() {
                    usersTableBody.innerHTML = '';

                    addButton(1, currentPage === 1);

                    if (totalPages > 5) {
                        if (currentPage > 3) {
                            let ellipsis = document.createElement('span');
                            ellipsis.classList.add('px-4', 'py-2');
                            ellipsis.innerHTML = '...';
                            usersTableBody.appendChild(ellipsis);
                        }

                        let startPage = Math.max(2, currentPage - 1);
                        endPage = Math.min(totalPages - 1, currentPage + 1);

                        for (let i = startPage; i <= endPage; i++) {
                            addButton(i, i === currentPage);
                        }

                        if (currentPage < totalPages - 2) {
                            let ellipsis = document.createElement('span');
                            ellipsis.classList.add('px-4', 'py-2');
                            ellipsis.innerHTML = '...';
                            usersTableBody.appendChild(ellipsis);
                        }
                    } else {
                        // Show all pages if total pages are <= 5
                        for (let i = 2; i <= totalPages; i++) {
                            addButton(i, i === currentPage);
                        }
                    }

                    // Always show the last page button
                    if (totalPages > 1 && totalPages > endPage  ) {
                        addButton(totalPages, currentPage === totalPages);
                    }
                }

                renderPagination();
            },
            error: function (xhr, status, error) {
                console.error('AJAX request failed: ', error);
            }
        });
    }

    fetchPaginationData();

    function updateStatus(status_name) {
        console.log('Status changed to:', status_name);
        fetchPaginationData();
    }



    function checker() {
        const tableContainer = document.getElementById('table-container');
        const pagination = document.getElementById('pagination');

        if (tableContainer.classList.value !== 'overflow-hidden max-h-[470px]') {
            pagination.classList.add('hidden');
        } else {
            const matchFound = document.querySelectorAll('#users-table tbody tr:not([style*="display: none"])').length > 0;
            if (matchFound && !searching) {
                pagination.classList.remove('hidden');
            } else {
                pagination.classList.add('hidden');
            }
        }
    }



</script>

