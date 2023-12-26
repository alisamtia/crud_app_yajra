<html>
    <head>
        <title>Crud App</title>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body>
@csrf
@php
    $edit_popup=$errors->has('edit_email')||$errors->has('edit_name')||$errors->has('edit_password');
    $create_popup=$errors->has('create_email')||$errors->has('create_name')||$errors->has('create_password');
@endphp

@if (session()->has('success'))
    <div id="success_msg" class="fixed border-green-800 border py-2 z-50 text-white top-2 right-2 bg-green-500 w-64 text-center rounded-xl ml-auto">
        {{ session("success") }}
    </div>
    <script>
        setTimeout(() => {
            $("#success_msg").hide(1000);
        }, 3000);
    </script>
@endif

<div id="create-modal" class="{{ $create_popup ? "" : "hidden"}} relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
          <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">


            <form id="create-form" action="/create" method="POST" class="max-w-sm mx-auto">
                @csrf
                <h3 class="text-3xl mb-5 mt-10 font-bold">Create a Field</h3>
                <div class="mb-5">
                    <label for="create_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                    <input value="{{ old("create_name") }}" type="text" name="create_name" id="create_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ali Samtia" required>
                @error("create_name")
                    <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                @enderror
                </div>
                <div class="mb-5">
                  <label for="create_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                  <input value="{{ old("create_email") }}" type="email" name="create_email" id="create_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>

                @error("create_email")
                  <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                @enderror

                </div>
                <div class="mb-5">
                  <label for="create_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                  <input type="password" name="create_password" id="create_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

                  @error("create_password")
                      <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                  @enderror

                </div>

          </div>
          <div class="bg-gray-50 gap-2 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="submit" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Save</button>
            <button id="create-close" type="button" class="text-white mt-3 inline-flex w-full justify-center text-white rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-500 sm:mt-0 sm:w-auto">Close</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>







    <div id="edit-modal" class="{{ $edit_popup ? "" : "hidden"}} relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
              <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">


                <form id="edit-form" action="/update" method="POST" class="max-w-sm mx-auto">
                    @csrf
                    <h3 class="text-3xl mb-5 mt-10 font-bold">Edit a Field</h3>
                    <div class="mb-5">
                        <label for="edit_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                        <input value="{{ old("edit_name") }}" type="text" name="edit_name" id="edit_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ali Samtia" required>
                    @error("edit_name")
                        <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="mb-5">
                      <label for="edit_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                      <input value="{{ old("edit_email") }}" type="email" name="edit_email" id="edit_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>

                    @error("edit_email")
                      <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                    @enderror

                    </div>
                    <div class="mb-5">
                      <label for="edit_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                      <input type="password" name="edit_password" id="edit_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>

                      @error("edit_password")
                          <p class="mt-1 text-red-500 text-xs">{{ $message }}</p>
                      @enderror

                    </div>

              </div>
              <div class="bg-gray-50 gap-2 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="submit" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Save</button>
                <button id="edit-close" type="button" class="mt-3 inline-flex w-full justify-center text-white rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-500 sm:mt-0 sm:w-auto">Close</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>









    <div class="lg:ml-52 mt-10 mb-10 flex flex-col gap-5">
    <div class="flex ml-auto mr-56">
        <button id="create_btn" class="bg-green-500 text-white py-2 px-7 text-lg">Create a New User</button>
    </div>
    <div class="w-4/5">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 user_datatable">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th width="180px">Action</th>
        </tr>
        </thead>
        <tbody></tbody>
        </table>
    </div></div>
</body>
<script>
$(document).ready(function() {
    var table = $('.user_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{{ route('index') }}}",
    columns: [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'email', name: 'email'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
    });
    });

    $(document).on("click",".edit",function(){
        $("#edit-modal").show(1000);
        var tr=$(this).closest('tr');
        $("#edit-form").prepend("<input type='hidden' id='id_edit' name='id' value='"+tr.attr('id')+"'>");
        $("#edit_email").val(tr.children().eq(2).html());
        $("#edit_name").val(tr.children().eq(1).html());
        $("#edit_password").val("");
    });

    $("#edit-close").click(function(){
        $("#edit-modal").hide(1000);
        $("#id_edit").remove();
    });

    $("#create_btn").click(function(){
        $("#create-modal").show(1000);
    });
    $("#create-close").click(function(){
        $("#create-modal").hide(1000);
    });
    </script>
</html>
