<?php

function star_color($num)
{
    if ($num >= 4) {
        return 'text-primary';
    } else {
        return 'text-amber';
    }
}

function star_bg_color($num)
{
    if ($num >= 4) {
        return 'bg-primary';
    } else {
        return 'bg-amber';
    }
}

function diff($old, $new)
{
    return $old !== $new;
}

function calculate_median($array)
{
    // perhaps all non numeric values should filtered out of $array here?
    $iCount = count($array);
    if ($iCount == 0) {
      throw new DomainException('Median of an empty array is undefined');
    }
    // if we're down here it must mean $array
    // has at least 1 item in the array.
    $middle_index = floor($iCount / 2);
    sort($array, SORT_NUMERIC);
    $median = $array[$middle_index]; // assume an odd # of items
    // Handle the even case by averaging the middle 2 items
    if ($iCount % 2 == 0) {
      $median = ($median + $array[$middle_index - 1]) / 2;
    }
    return $median;
}

function me_img()
{
    return '<img src="https://avatars2.githubusercontent.com/u/1255050?v=4" style="width: 40px; border-radius: 50%;">';
}

function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
{
    $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
    $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
    parse_str(request()->getQueryString(), $query);
    unset($query[$pageName]);
    $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentPageItems,
        $collection->count(),
        $perPage,
        $currentPage,
        [
            'pageName' => $pageName,
            'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
            'query' => $query,
            'fragment' => $fragment
        ]
    );

    return $paginator;
}

function addressLink($address)
{
    $address = trim($address);

    return 'https://www.google.com/maps/place/' . $address;
}

function theme_path($name)
{
    $theme = config('listbox.theme');

    return "themes.$theme.$name";
}
