<x-agent-dashboard.dashboard-layout >
    <!-- Form Content -->
        <div class="p-6">
            <form action="/dashboard/property/create" method="POST" enctype="multipart/form-data" id="propertyForm" class="space-y-6">
                
                @csrf

                <!-- Property Information --> 
                <div class="form-card rounded-2xl p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-[#00ff88]/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Property Information</h3>
                            <p class="text-gray-400 text-sm">Basic details about the property</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-gray-300 text-sm font-medium mb-2">Property Title *</label>
                            <input 
                                type="text" 
                                name="title" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                placeholder="e.g., Modern 3BR Apartment in Bole" 
                                value="{{ old('title') }}"
                                required>
                                <x-form-input-error fildName="title" />
                        </div>
                        
                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Property Type *</label>
                            <select name="type" class="form-input w-full px-4 py-3 rounded-lg text-white" value="{{ old('type') }}" required>
                                <option value="">Select property type</option>
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                                <option value="land">Land</option>
                                <option value="commercial">Commercial</option>
                                <option value="villa">Villa</option>
                                <option value="condominium">Condominium</option>
                            </select>
                            <x-form-input-error fildName="type" />
                        </div>

                        <div class="currency-input">
                            <label class="block text-gray-300 text-sm font-medium mb-2">Price (ETB) *</label>
                            {{-- <span class="currency-symbol">ETB</span> --}}
                            <input 
                                type="number" 
                                name="price" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                placeholder="0" 
                                min="0" 
                                step="1000" 
                                value="{{ old('price') }}"
                                required>
                                <x-form-input-error fildName="price" />
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-gray-300 text-sm font-medium mb-2">Location *</label>
                            <div class="flex space-x-2">
                                <input 
                                    type="text" 
                                    name="location" 
                                    class="form-input flex-1 px-4 py-3 rounded-lg text-white" 
                                    placeholder="e.g., Bole, Addis Ababa" 
                                    value="{{ old('location') }}"
                                    required>
                                    <x-form-input-error fildName="location" />
                                <button type="button" class="secondary-button px-4 py-3 rounded-lg font-medium" onclick="openMapPicker()">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div> 

                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">longitude *</label>
                             <input 
                                type="number" 
                                name="longitude" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                placeholder="12.5156" 
                                value="{{ old('longitude') }}"
                                required>
                                <x-form-input-error fildName="longitude" />
                        </div>

                        <div class="currency-input">
                            <label class="block text-gray-300 text-sm font-medium mb-2">latitude</label>
                            <input 
                                type="number" 
                                name="latitude" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                placeholder="12.5156" 
                                value="{{ old('latitude') }}" 
                                required>
                                <x-form-input-error fildName="latitude" />
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-gray-300 text-sm font-medium mb-2">Description *</label>
                            <textarea 
                                name="description" 
                                rows="4" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white resize-none" 
                                placeholder="Describe the property features, location benefits, and unique selling points..."
                                required></textarea>
                                <x-form-input-error fildName="description" />
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="form-card rounded-2xl p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Property Details</h3>
                            <p class="text-gray-400 text-sm">Specifications and features</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Bedrooms</label>
                            <input 
                                type="number" 
                                name="bedrooms" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                placeholder="0" 
                                min="0" 
                                max="20"
                                value="{{ old('bedrooms') }}"
                                >
                                <x-form-input-error fildName="bedrooms" />
                        </div>

                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Bathrooms</label>
                            <input 
                                type="number" 
                                name="bathrooms" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                value="{{ old('bathrooms') }}"
                                placeholder="0" min="0" max="20" step="0.5">
                                <x-form-input-error fildName="bathrooms" />
                        </div>

                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Square Meters</label>
                            <input 
                                type="number" 
                                name="area" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                value="{{ old('area') }}"
                                placeholder="0" min="0" step="0.1">
                                <x-form-input-error fildName="area" />
                        </div>

                        <div>
                            <label class="block text-gray-300 text-sm font-medium mb-2">Year Built</label>
                            <input 
                                type="number" 
                                name="yearBuilt" 
                                class="form-input w-full px-4 py-3 rounded-lg text-white" 
                                value="{{ old('yearBuilt') }}"
                                placeholder="2024" min="1900" max="2024">
                                <x-form-input-error fildName="yearBuilt" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-4">Amenities</label>
                        <div class="checkbox-group">
                            <label class="checkbox-item">
                                <input type="checkbox" name="amenities[]" value="parking" class="sr-only">
                                <div class="checkbox-content flex-1">
                                    <div class="flex items-center">
                                        <div class="checkbox-icon w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-3 transition-all">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Parking</span>
                                    </div>
                                </div>
                            </label>

                            <label class="checkbox-item">
                                <input type="checkbox" name="amenities[]" value="balcony" class="sr-only">
                                <div class="checkbox-content flex-1">
                                    <div class="flex items-center">
                                        <div class="checkbox-icon w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-3 transition-all">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M10 10v2H8v-2h2zm6 0v2h-2v-2h2zm-3 6v2h-2v-2h2zm-3-3v2H8v-2h2zm6 0v2h-2v-2h2z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Balcony</span>
                                    </div>
                                </div>
                            </label>

                            <label class="checkbox-item">
                                <input type="checkbox" name="amenities[]" value="pool" class="sr-only">
                                <div class="checkbox-content flex-1">
                                    <div class="flex items-center">
                                        <div class="checkbox-icon w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-3 transition-all">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M22 21c-1.11 0-1.73-.37-2.18-.64-.37-.22-.6-.36-1.15-.36-.56 0-.78.13-1.15.36-.46.27-1.07.64-2.18.64s-1.73-.37-2.18-.64c-.37-.22-.6-.36-1.15-.36-.56 0-.78.13-1.15.36-.46.27-1.07.64-2.18.64s-1.73-.37-2.18-.64c-.37-.22-.6-.36-1.15-.36-.56 0-.78.13-1.15.36-.46.27-1.08.64-2.19.64v-2c.56 0 .78-.13 1.15-.36.46-.27 1.08-.64 2.19-.64s1.73.37 2.18.64c.37.22.59.36 1.15.36.56 0 .78-.13 1.15-.36.46-.27 1.08-.64 2.19-.64 1.11 0 1.73.37 2.18.64.37.22.59.36 1.15.36.56 0 .78-.13 1.15-.36.46-.27 1.08-.64 2.19-.64s1.73.37 2.18.64c.37.22.59.36 1.15.36v2zm0-4.5c-1.11 0-1.73-.37-2.18-.64-.37-.22-.6-.36-1.15-.36-.56 0-.78.13-1.15.36-.46.27-1.07.64-2.18.64s-1.73-.37-2.18-.64c-.37-.22-.6-.36-1.15-.36-.56 0-.78.13-1.15.36-.46.27-1.07.64-2.18.64s-1.73-.37-2.18-.64c-.37-.22-.6-.36-1.15-.36-.56 0-.78.13-1.15.36-.46.27-1.08.64-2.19.64v-2c.56 0 .78-.13 1.15-.36.46-.27 1.08-.64 2.19-.64s1.73.37 2.18.64c.37.22.59.36 1.15.36.56 0 .78-.13 1.15-.36.46-.27 1.08-.64 2.19-.64 1.11 0 1.73.37 2.18.64.37.22.59.36 1.15.36.56 0 .78-.13 1.15-.36.46-.27 1.08-.64 2.19-.64s1.73.37 2.18.64c.37.22.59.36 1.15.36v2z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Swimming Pool</span>
                                    </div>
                                </div>
                            </label>

                            <label class="checkbox-item">
                                <input type="checkbox" name="amenities[]" value="security" class="sr-only">
                                <div class="checkbox-content flex-1">
                                    <div class="flex items-center">
                                        <div class="checkbox-icon w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-3 transition-all">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,7C13.4,7 14.8,8.6 14.8,10V11H16V16H8V11H9.2V10C9.2,8.6 10.6,7 12,7M12,8.2C11.2,8.2 10.4,8.7 10.4,10V11H13.6V10C13.6,8.7 12.8,8.2 12,8.2Z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Security</span>
                                    </div>
                                </div>
                            </label>

                            <label class="checkbox-item">
                                <input type="checkbox" name="amenities[]" value="garden" class="sr-only">
                                <div class="checkbox-content flex-1">
                                    <div class="flex items-center">
                                        <div class="checkbox-icon w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-3 transition-all">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12,2A2,2 0 0,1 14,4C14,4.74 13.6,5.39 13,5.73V7H14A7,7 0 0,1 21,14H22A1,1 0 0,1 23,15V18A1,1 0 0,1 22,19H21V20A2,2 0 0,1 19,22H5A2,2 0 0,1 3,20V19H2A1,1 0 0,1 1,18V15A1,1 0 0,1 2,14H3A7,7 0 0,1 10,7H11V5.73C10.4,5.39 10,4.74 10,4A2,2 0 0,1 12,2M7.5,13A0.5,0.5 0 0,0 7,13.5A0.5,0.5 0 0,0 7.5,14A0.5,0.5 0 0,0 8,13.5A0.5,0.5 0 0,0 7.5,13M9.5,14A0.5,0.5 0 0,0 9,14.5A0.5,0.5 0 0,0 9.5,15A0.5,0.5 0 0,0 10,14.5A0.5,0.5 0 0,0 9.5,14Z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Garden</span>
                                    </div>
                                </div>
                            </label>

                            <label class="checkbox-item">
                                <input type="checkbox" name="amenities[]" value="gym" class="sr-only">
                                <div class="checkbox-content flex-1">
                                    <div class="flex items-center">
                                        <div class="checkbox-icon w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-3 transition-all">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20.57,14.86L22,13.43L20.57,12L17,15.57L8.43,7L12,3.43L10.57,2L9.14,3.43L7.71,2L5.57,4.14L4.14,2.71L2.71,4.14L4.14,5.57L2,7.71L3.43,9.14L2,10.57L3.43,12L7,8.43L15.57,17L12,20.57L13.43,22L14.86,20.57L16.29,22L18.43,19.86L19.86,21.29L21.29,19.86L19.86,18.43L22,16.29L20.57,14.86Z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">Gym</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="form-card rounded-2xl p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-purple-400/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Property Images</h3>
                            <p class="text-gray-400 text-sm">Upload high-quality photos of the property</p>
                        </div>
                    </div>

                    <div class="upload-area rounded-xl p-8 text-center mb-6" id="uploadArea">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <h4 class="text-white font-medium mb-2">Drop images here or click to upload</h4>
                        <p class="text-gray-400 text-sm mb-4">Support: JPG, PNG, WebP (Max 5MB each)</p>
                        <input type="file" name="images[]" id="imageInput" multiple accept="image/*" class="hidden">
                        <button type="button" class="primary-button px-6 py-3 rounded-lg text-[#12181f] font-medium" onclick="document.getElementById('imageInput').click()">
                            Choose Images
                        </button>
                        
                    </div>
                    <x-form-input-error fildName="images" />
                    <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-4 gap-4 hidden">
                        <!-- Image previews will be inserted here -->
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <button type="button" class="secondary-button px-8 py-3 rounded-lg font-medium" onclick="cancelForm()">
                        Cancel
                    </button>
                    <button type="submit" class="primary-button px-8 py-3 rounded-lg text-[#12181f] font-medium">
                        Save Property
                    </button>
                </div>
            </form>
        </div>

        <!-- Success Modal -->
    {{-- <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="form-card rounded-2xl p-8 w-full max-w-md mx-4 text-center">
            <div class="w-16 h-16 bg-[#00ff88]/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-[#00ff88]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Property Added Successfully!</h3>
            <p class="text-gray-400 mb-6">Your property listing has been created and is now live.</p>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <button class="secondary-button flex-1 px-4 py-3 rounded-lg font-medium" onclick="viewProperty()">
                    View Property
                </button>
                <button class="primary-button flex-1 px-4 py-3 rounded-lg text-[#12181f] font-medium" onclick="addAnother()">
                    Add Another
                </button>
            </div>
        </div>
    </div> --}}

</x-agent-dashboard.dashboard-layout>

</body>
</html>
