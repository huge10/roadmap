<div class="hidden lg:block">
    <aside class="w-60" aria-label="Sidebar">
        <div class="overflow-y-auto space-y-4">
            <ul class="space-y-2">
                <li>
                    <a
                        @class([
                                'flex items-center h-10 px-2 space-x-2 transition rounded-lg',
                                'text-white bg-brand-500 dark:bg-white/5 dark:hover:bg-white/5 dark:text-brand-400' => request()->is('/'),
                                'hover:bg-gray-500/5 focus:bg-brand-500/10 focus:text-brand-600 focus:outline-none dark:hover:bg-white/5 dark:text-brand-500' => !request()->is('/')
                            ])
                        href="{{ route('home') }}">

                        <x-heroicon-o-home class="w-5 h-5 {{ !request()->is('/') ? 'text-gray-500' : ''  }}"/>

                        <span
                            class="font-normal {{ !request()->is('/') ? 'text-gray-900 dark:text-gray-200' : ''  }}">{{ trans('general.dashboard') }}</span>
                    </a>
                </li>

                <li>
                    <a
                        @class([
                            'flex items-center h-10 px-2 space-x-2 transition rounded-lg',
                            'text-white bg-brand-500 dark:bg-white/5 dark:hover:bg-white/5 dark:text-brand-400' => request()->is('my'),
                            'hover:bg-gray-500/5 focus:bg-brand-500/10 focus:text-brand-600 focus:outline-none dark:hover:bg-white/5 dark:focus:text-gray-200 dark:text-gray-200' => !request()->is('my')
                        ])
                        href="{{ route('my') }}">
                        <x-heroicon-o-queue-list class="w-5 h-5 {{ !request()->is('my') ? 'text-gray-500' : ''  }}"/>

                        <span class="font-medium">{{ trans('items.my-items') }}</span>
                    </a>
                </li>

                <li>
                    <a
                        @class([
                            'flex items-center h-10 px-2 space-x-2 transition rounded-lg',
                            'text-white bg-brand-500 dark:bg-white/5 dark:hover:bg-white/5 dark:text-brand-400' => request()->is('profile'),
                            'hover:bg-gray-500/5 focus:bg-brand-500/10 focus:text-brand-600 focus:outline-none dark:hover:bg-white/5 dark:focus:text-gray-200 dark:text-gray-200' => !request()->is('profile')
                        ])
                        href="{{ route('profile') }}">
                        <x-heroicon-o-user class="w-5 h-5 {{ !request()->is('profile') ? 'text-gray-500' : ''  }}"/>

                        <span class="font-medium">{{ trans('auth.profile') }}</span>
                    </a>
                </li>

                @if(app(App\Settings\GeneralSettings::class)->enable_changelog)
                    <li>
                        <a
                            @class([
                                'flex items-center h-10 px-2 space-x-2 transition rounded-lg',
                                'text-white bg-brand-500 dark:bg-white/5 dark:hover:bg-white/5 dark:text-brand-400' => request()->is('changelog*'),
                                'hover:bg-gray-500/5 focus:bg-brand-500/10 focus:text-brand-600 focus:outline-none dark:hover:bg-white/5 dark:focus:text-gray-200 dark:text-gray-200' => !request()->is('changelog*')
                            ])
                            href="{{ route('changelog') }}">
                            <x-heroicon-o-rss
                                class="w-5 h-5 {{ !request()->is('changelog*') ? 'text-gray-500' : ''  }}"/>

                            <span class="font-medium">{{ trans('changelog.changelog') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
            <div>
                <p class="px-2 text-lg font-semibold mb-2">{{ trans('projects.projects') }}</p>
                @if($projects->count() > 0)
                    <ul class="space-y-2">
                        @foreach($projects->groupBy('group') as $group => $projects)
                            @if($group)
                                <li class="mb-3">
                                <div
                                    class="flex items-center h-2 px-2 space-x-2 transition rounded-lg mt-5"
                                >
                                    <span class="font-normal text-gray-500 truncate">{{ $group }}</span>

                                </div>
                                </li>
                            @endif

                            @foreach($projects as $project)
                                <li>
                                    <a
                                        title="{{ $project->title }}"
                                        @class([
                                       'flex items-center h-10 px-2 space-x-2 transition rounded-lg',
                                       'text-white bg-brand-500 dark:bg-white/5 dark:hover:bg-white/5 dark:text-brand-400' => request()->segment(2) === $project->slug,
                                       'hover:bg-gray-500/5 focus:bg-brand-500/10 focus:text-brand-600 focus:outline-none dark:hover:bg-white/5 dark:focus:text-gray-200 dark:text-gray-200' => request()->segment(2) !== $project->slug
                                   ])
                                        href="{{ route('projects.show', $project) }}">
                                        <x-dynamic-component :component="$project->icon ?? 'heroicon-o-hashtag'"
                                                             class="flex-shrink-0 w-5 h-5 {{ request()->segment(2) == $project->slug ? '' : 'text-gray-500'  }}"/>

                                        <span class="font-normal truncate">{{ $project->title }}</span>

                                        @if($project->private)
                                            <div class="flex-1 flex justify-end">
                                                <x-heroicon-s-lock-closed
                                                    class="w-4 h-4 {{ request()->segment(2) == $project->slug ? '' : 'text-primary'  }}"/>
                                            </div>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                @else
                    <div class="px-2">
                        <span class="text-sm text-gray-500">{{ trans('projects.no-projects') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </aside>
</div>
