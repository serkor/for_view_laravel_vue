<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\FavoriteLogicInterface;
use App\Models\Executor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class FavoriteLogic implements FavoriteLogicInterface
{
    protected $executor;

    public function __construct(Executor $executor)
    {
        $this->executor = $executor;
    }

    public function get_ids()
    {
        return DB::table('customer_favorites')
            ->where('customer_id', Auth::id())
            ->pluck('executor_id')->toArray();
    }

    public function get_list()
    {
        $ids = $this->get_ids();
        $favorites = $this->executor->whereIn('id', $ids)
            ->where('type', 2)
            ->where('verified', 1)
            ->where('show_profile', 'on')
            ->paginate(9);

        return [
            'favorites' => $favorites,
            'all_count' => $favorites->total()
        ];
    }

    public function query_all_list()
    {
        $ids = $this->get_ids();
        $favorites = $this->executor->whereIn('id', $ids)->get();

        return [
            'favorites' => $favorites,
            'all_count' => count($favorites)
        ];
    }

    public function add($id)
    {
        DB::table('customer_favorites')
            ->insert([
                'customer_id' => Auth::id(),
                'executor_id' => $id
            ]);
        return true;
    }

    public function del($id)
    {
        DB::table('customer_favorites')
            ->where('customer_id', Auth::id())
            ->where('executor_id', $id)
            ->delete();
        return true;
    }

}
