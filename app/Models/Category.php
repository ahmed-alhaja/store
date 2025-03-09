<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'parent_id', 'description','image',  'status', 'slug'
        // fillable gegen guarded
    ];

    public function scopeActive(Builder $bulider)  
    {
        $bulider-> where('status' ,  '='  , 'active');
    }
    public function scopeFilter(Builder $bulider , $filters)  
    {

        $bulider->when($filters['name'] ?? false , function ($bulider , $value) {
            $bulider->where('name' , 'LIKE' , "%{$value}%");
        });
        $bulider->when($filters['status'] ?? false , function ($bulider , $value) {
            $bulider->where('status' , $value);
        });

    }
//     public function scopeFilter(Builder $builder, array $filters)
// {
//     foreach ($filters as $key => $value) {
//         if (!empty($value)) {
//             if ($key === 'name') {
//                 $builder->where($key, 'LIKE', "%{$value}%");
//             } else {
//                 $builder->where($key, $value);
//             }
//         }
//     }
// }


    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3,max:255',
                Rule::unique('categories' , 'name')->ignore($id) , 
                // function ($atrr , $value , $fails) {
                //     if (strtolower($value) == 'laravel')  
                //     $fails('this name is forbiden');
                // } ,
                new Filter(['laravel' , 'php' , 'MySql'])
            ],
            'parent_id' => [
                'nullable',
                'int',
                'exists:categories,id'
            ],
            'image' => [
                'image',
                'max:1048576',
                'dimensions:min_width=100 , min_height=100'
            ],
            'status' => 'required|in:active,inactive'
        ];
    }
}
