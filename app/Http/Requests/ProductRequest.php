<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $req = $this->isMethod('POST') ? 'required' : 'nullable';
        return [
            'name'             => ['required', 'string', 'max:255'],
            'thumbnail'        => [$req, 'image', 'mimes:png,jpg,bmp,svg,jpeg', 'max:2048'],
            'preview_images'   => [$req, 'array'],
            'preview_images.*' => ['image', 'mimes:png,jpg,bmp,svg,jpeg', 'max:2048'],
            'categories'       => ['required', 'array'],
            'categories.*'     => ['required', 'integer', 'exists:categories,id'],
        ];
    }

    /**
     * Update or store current requested data
     *
     * @param \App\Models\Product $product
     */
    public function saved(?Product $product = null) : bool
    {
        $input = $this->validated();
        $preview_images = [];

        if($this->hasFile('preview_images')) {
            if($this->isMethod('PUT')) {
                foreach ($product->preview_images as $preview_image) {
                    deleteUploadedFile($preview_image);
                }
            }
            foreach ($this->preview_images as $reqImage) {
                $preview_images[] = fileUpload($reqImage, 'product');
            }
        }
        else {
            $preview_images = $product->preview_images;
        }

        $input['preview_images'] = $preview_images;
        $input['thumbnail'] = $this->hasFile('thumbnail') ? fileUpload($this->file('thumbnail'), 'product') : null;

        if($this->isMethod('POST')) {
            $product = Product::query()->create($input);
        }
        else {
            $product->update($input);
        }

        $product->categories()->sync($this->categories);

        return true;
    }
}
