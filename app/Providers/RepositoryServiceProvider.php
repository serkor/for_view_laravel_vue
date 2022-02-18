<?php

namespace App\Providers;

use App\Logics\Interfaces\AppealLogicInterface;
use App\Logics\Interfaces\BidCommentLogicInterface;
use App\Logics\Interfaces\BidLogicInterface;
use App\Logics\Interfaces\BidStatusLogicInterface;
use App\Logics\Interfaces\BlogCategoryLogicInterface;
use App\Logics\Interfaces\BlogArticleLogicInterface;
use App\Logics\Interfaces\CarLogicInterface;
use App\Logics\Interfaces\CatalogLogicInterface;
use App\Logics\Interfaces\CategoryLogicInterface;
use App\Logics\Interfaces\CustomerBidLogicInterface;
use App\Logics\Interfaces\CustomerLogicInterface;
use App\Logics\Interfaces\CustomerOrderLogicInterface;
use App\Logics\Interfaces\ExecutorBidLogicInterface;
use App\Logics\Interfaces\ExecutorLogicInterface;
use App\Logics\Interfaces\MessageLogicInterface;
use App\Logics\Interfaces\ExecutorOrderLogicInterface;
use App\Logics\Interfaces\FavoriteLogicInterface;
use App\Logics\Interfaces\FileLogicInterface;
use App\Logics\Interfaces\LanguageLogicInterface;
use App\Logics\Interfaces\MarkLogicInterface;
use App\Logics\Interfaces\MarkModelLogicInterface;
use App\Logics\Interfaces\NotificationLogicInterface;
use App\Logics\Interfaces\OfferLogicInterface;
use App\Logics\Interfaces\OfferTemplateLogicInterface;
use App\Logics\Interfaces\PackageLogicInterface;
use App\Logics\Interfaces\PaymentLogicInterface;
use App\Logics\Interfaces\PaymentTypeLogicInterface;
use App\Logics\Interfaces\ReviewLogicInterface;
use App\Logics\Interfaces\TransmissionLogicInterface;
use App\Logics\Interfaces\UserLogicInterface;
use App\Logics\Interfaces\YearLogicInterface;
use App\Logics\Repositories\AppealLogic;
use App\Logics\Repositories\BidCommentLogic;
use App\Logics\Repositories\BidLogic;
use App\Logics\Repositories\BidStatusLogic;
use App\Logics\Repositories\BlogArticleLogic;
use App\Logics\Repositories\BlogCategoryLogic;
use App\Logics\Repositories\CarLogic;
use App\Logics\Repositories\CatalogLogic;
use App\Logics\Repositories\CategoryLogic;
use App\Logics\Repositories\CustomerBidLogic;
use App\Logics\Repositories\CustomerLogic;
use App\Logics\Repositories\CustomerOrderLogic;
use App\Logics\Repositories\ExecutorBidLogic;
use App\Logics\Repositories\ExecutorLogic;
use App\Logics\Repositories\MessageLogic;
use App\Logics\Repositories\ExecutorOrderLogic;
use App\Logics\Repositories\FavoriteLogic;
use App\Logics\Repositories\FileLogic;
use App\Logics\Repositories\LanguageLogic;
use App\Logics\Repositories\MarkLogic;
use App\Logics\Repositories\MarkModelLogic;
use App\Logics\Repositories\NotificationLogic;
use App\Logics\Repositories\OfferLogic;
use App\Logics\Repositories\OfferTemplateLogic;
use App\Logics\Repositories\PackageLogic;
use App\Logics\Repositories\PaymentLogic;
use App\Logics\Repositories\PaymentTypeLogic;
use App\Logics\Repositories\ReviewLogic;
use App\Logics\Repositories\TransmissionLogic;
use App\Logics\Repositories\UserLogic;
use App\Logics\Repositories\YearLogic;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AppealLogicInterface::class,
            AppealLogic::class
        );
        $this->app->bind(
            BlogArticleLogicInterface::class,
            BlogArticleLogic::class
        );
        $this->app->bind(
            BlogCategoryLogicInterface::class,
            BlogCategoryLogic::class
        );
        $this->app->bind(
            CategoryLogicInterface::class,
            CategoryLogic::class
        );
        $this->app->bind(
            CustomerLogicInterface::class,
            CustomerLogic::class
        );
        $this->app->bind(
            ExecutorLogicInterface::class,
            ExecutorLogic::class
        );
        $this->app->bind(
            FavoriteLogicInterface::class,
            FavoriteLogic::class
        );
        $this->app->bind(
            FileLogicInterface::class,
            FileLogic::class
        );
        $this->app->bind(
            LanguageLogicInterface::class,
            LanguageLogic::class
        );
        $this->app->bind(
            ReviewLogicInterface::class,
            ReviewLogic::class
        );
        $this->app->bind(
            UserLogicInterface::class,
            UserLogic::class
        );
        $this->app->bind(
            MarkLogicInterface::class,
            MarkLogic::class
        );
        $this->app->bind(
            MarkModelLogicInterface::class,
            MarkModelLogic::class
        );
        $this->app->bind(
            TransmissionLogicInterface::class,
            TransmissionLogic::class
        );
        $this->app->bind(
            YearLogicInterface::class,
            YearLogic::class
        );
        $this->app->bind(
            PaymentTypeLogicInterface::class,
            PaymentTypeLogic::class
        );
        $this->app->bind(
            CarLogicInterface::class,
            CarLogic::class
        );
        $this->app->bind(
            PackageLogicInterface::class,
            PackageLogic::class
        );
        $this->app->bind(
            BidLogicInterface::class,
            BidLogic::class
        );
        $this->app->bind(
            OfferLogicInterface::class,
            OfferLogic::class
        );
        $this->app->bind(
            BidStatusLogicInterface::class,
            BidStatusLogic::class
        );
        $this->app->bind(
            PaymentLogicInterface::class,
            PaymentLogic::class
        );
        $this->app->bind(
            ExecutorBidLogicInterface::class,
            ExecutorBidLogic::class
        );
        $this->app->bind(
            CustomerBidLogicInterface::class,
            CustomerBidLogic::class
        );
        $this->app->bind(
            CatalogLogicInterface::class,
            CatalogLogic::class
        );
        $this->app->bind(
            BidCommentLogicInterface::class,
            BidCommentLogic::class
        );
        $this->app->bind(
            NotificationLogicInterface::class,
            NotificationLogic::class
        );
        $this->app->bind(
            CustomerOrderLogicInterface::class,
            CustomerOrderLogic::class
        );
        $this->app->bind(
            ExecutorOrderLogicInterface::class,
            ExecutorOrderLogic::class
        );
        $this->app->bind(
            MessageLogicInterface::class,
            MessageLogic::class
        );
        $this->app->bind(
            OfferTemplateLogicInterface::class,
            OfferTemplateLogic::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
