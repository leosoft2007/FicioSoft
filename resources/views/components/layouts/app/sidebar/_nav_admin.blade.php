<flux:dropdown>
                                <flux:profile name="Administrador"  icon-trailing="chevrons-up-down" />
                                <flux:menu>
                                    <flux:menu.radio.group>
                                        <flux:navlist.item icon="users" :href="route('users.index')"
                                            :current="request()->routeIs('users.*')" wire:navigate>{{ __('Users') }}
                                        </flux:navlist.item>
                                    </flux:menu.radio.group>
                                    <flux:menu.radio.group>
                                        <flux:navlist.item icon="users" :href="route('clinicas.index')"
                                            :current="request()->routeIs('clinicas.*')" wire:navigate>{{ __('Clinicas') }}
                                        </flux:navlist.item>
                                    </flux:menu.radio.group>
                                    <flux:menu.radio.group>
                                        <flux:navlist.item icon="shield-check" :href="route('roles-permissions')"
                                            :current="request()->routeIs('roles-permissions.*')" wire:navigate>
                                            {{ __('Roles & Permissions') }}</flux:navlist.item>
                                    </flux:menu.radio.group>
                                </flux:menu>
                            </flux:dropdown>
