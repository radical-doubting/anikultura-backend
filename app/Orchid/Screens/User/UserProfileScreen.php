<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Actions\User\ChangePassword;
use App\Actions\User\EditUserProfile;
use App\Orchid\Layouts\User\ProfilePasswordLayout;
use App\Orchid\Layouts\User\ProfileUserEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class UserProfileScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'My account';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Update your account details such as name, email address and password';

    /**
     * Query data.
     *
     * @param  Request  $request
     * @return array
     */
    public function query(Request $request): array
    {
        return [
            'user' => $request->user(),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::block(ProfileUserEditLayout::class)
                ->title(__('Profile Information'))
                ->description(__("Update your account's profile information and email address."))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),

            Layout::block(ProfilePasswordLayout::class)
                ->title(__('Update Password'))
                ->description(__('Ensure your account is using a long, random password to stay secure.'))
                ->commands(
                    Button::make(__('Update password'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('changePassword')
                ),
        ];
    }

    public function save(Request $request): RedirectResponse
    {
        return EditUserProfile::runOrchidAction(null, $request);
    }

    public function changePassword(Request $request): RedirectResponse
    {
        return ChangePassword::runOrchidAction(null, $request);
    }
}
