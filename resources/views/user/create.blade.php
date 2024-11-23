<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <h5 class="card-title fw-semibold mb-4">Add Kasir</h5>
                        </div>

                        <!-- Form untuk menambahkan user -->
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf <!-- Menyertakan token CSRF untuk keamanan -->

                            <div class="mb-3 row">
                                <x-input-label for="username" :value="__('Username')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <x-text-input id="username" name="username" type="text" class="form-control"
                                        :value="old('username')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('username')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <x-input-label for="name" :value="__('Name')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <x-text-input id="name" name="name" type="text" class="form-control"
                                        :value="old('name')" required autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <x-input-label for="email" :value="__('Email')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <x-text-input id="email" name="email" type="email" class="form-control"
                                        :value="old('email')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <x-input-label for="address" :value="__('Address')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <textarea id="address" name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <x-input-label for="contact" :value="__('Contact')"
                                    class="col-sm-2 col-form-label text-nowrap" />
                                <div class="col-sm-10">
                                    <x-text-input id="contact" name="contact" type="text" class="form-control"
                                        :value="old('contact')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('contact')" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 d-flex justify-content-center gap-1">
                                    <a class="btn btn-danger" href="{{ route('user.index') }}"
                                        style="width: 100px;">Back</a>
                                    <button type="submit" class="btn btn-info" style="width: 100px;">Add User</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
