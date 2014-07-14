<?php

class CategoriesController extends BaseController
{

    public function addCat()
    {
        $message = '';
        $newCatName = '';

        if (Input::has('name')) {
            $cat = new Category;
            if ($cat->add(Input::get('name'))) {
                $message = 'Категория успешно добавлена!';
            } else {
                $message = 'Введите корректное имя категории';
                $newCatName = Input::get('name');
            }
        }

        $categories = Category::all();
        return View::make('admin.addCategory',
            array('message' => $message, 'newCatName' => $newCatName,
                'categories' => $categories));
    }

    public function editCat($id)
    {
        if (is_numeric($id)) {
            $message = '';
            $cat = Category::find($id);

            if (Input::has('name')) {
                if ($cat->edit(Input::get('name'))) {
                    $message = 'Категория успешно отредактирована!';
                } else {
                    $message = 'Введите корректное имя категории';
                }
            }

            $categories = Category::all();

            return View::make('admin.editCategory',
                array('message' => $message, 'cat' => $cat,
                    'categories' => $categories));
        }

    }

    public function delCat($id)
    {
        if (is_numeric($id)) {
            $message = '';
            $cat = Category::find($id);

            if (Input::has('is') && Input::get('is') == 1) {
                if ( $cat->delete() ) {
                    $message = 'Категория успешно удалена!';
                    $categories = Category::all();
                    $newCatName = '';
                    return View::make('admin.addCategory',
                        array('message' => $message, 'newCatName' => $newCatName,
                            'categories' => $categories));

                } else {
                    $categories = Category::all();
                    $message = 'УУУпс. Ошибонька.';
                    return View::make('admin.delCategory',
                        array('message' => $message, 'cat' => $cat,
                            'categories' => $categories));
                }
            }

            $categories = Category::all();

            return View::make('admin.delCategory',
                array('message' => $message, 'cat' => $cat,
                    'categories' => $categories));
        }

    }

}
