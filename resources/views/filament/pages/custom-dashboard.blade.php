<x-filament-panels::page>
    <style>
        .dashboard-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            padding: 1.25rem;
            border: 1px solid #e5e7eb;
            transition: box-shadow 0.2s;
        }
        .dashboard-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .stat-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            padding: 1.25rem;
            border: 1px solid #e5e7eb;
        }
        .welcome-banner {
            background: linear-gradient(to right, #da3322, #c42e1f);
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            color: white;
        }
        .info-section {
            background: linear-gradient(to bottom right, #da3322, #c42e1f, #ae2819);
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
    </style>
    
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        {{-- Welcome Section --}}
        <div class="welcome-banner">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">
                Welcome to Women in Film Admin Panel
            </h2>
            <p style="color: rgba(255, 255, 255, 0.9);">
                Manage your website content, track engagement, and monitor your community growth.
            </p>
        </div>

        {{-- Statistics Overview --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            @foreach($this->getStats() as $stat)
                <div class="stat-card">
                    <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                        <div style="flex: 1;">
                            <p style="font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">
                                {{ $stat['label'] }}
                            </p>
                            <p style="font-size: 1.5rem; font-weight: 700; color: #111827; margin-bottom: 0.25rem;">
                                {{ $stat['value'] }}
                            </p>
                            @if(isset($stat['description']))
                                <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">
                                    {{ $stat['description'] }}
                                </p>
                            @endif
                        </div>
                        @if(isset($stat['icon']))
                            <div style="margin-left: 0.75rem; padding: 0.375rem; border-radius: 0.5rem; background: {{ $stat['color'] === 'success' ? '#f0fdf4' : ($stat['color'] === 'info' ? '#eff6ff' : ($stat['color'] === 'warning' ? '#fefce8' : '#fef2f2')) }};">
                                <div style="width: 16px; height: 16px; color: {{ $stat['color'] === 'success' ? '#16a34a' : ($stat['color'] === 'info' ? '#2563eb' : ($stat['color'] === 'warning' ? '#ca8a04' : '#dc2626')) }};">
                                    @svg($stat['icon'], ['style' => 'width: 16px; height: 16px;'])
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Quick Actions --}}
        <div class="dashboard-card">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin-bottom: 1.25rem; display: flex; align-items: center;">
                <span style="margin-right: 0.5rem;">⚡</span>
                Quick Actions
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                <a href="{{ route('filament.admin.resources.blog-posts.create') }}" 
                   style="display: flex; align-items: center; padding: 1rem; border: 2px solid #e5e7eb; border-radius: 0.75rem; text-decoration: none; transition: all 0.2s;"
                   onmouseover="this.style.borderColor='#93c5fd'; this.style.backgroundColor='#eff6ff';"
                   onmouseout="this.style.borderColor='#e5e7eb'; this.style.backgroundColor='transparent';">
                    <div style="padding: 0.5rem; background: #dbeafe; border-radius: 0.5rem; margin-right: 1rem;">
                        <div style="width: 14px; height: 14px; color: #2563eb;">
                            @svg('heroicon-o-document-plus', ['style' => 'width: 14px; height: 14px;'])
                        </div>
                    </div>
                    <div>
                        <p style="font-weight: 600; color: #111827; margin: 0;">New Blog Post</p>
                        <p style="font-size: 0.75rem; color: #6b7280; margin: 0.125rem 0 0 0;">Create a new article</p>
                    </div>
                </a>

                <a href="{{ route('filament.admin.resources.projects.create') }}" 
                   style="display: flex; align-items: center; padding: 1rem; border: 2px solid #e5e7eb; border-radius: 0.75rem; text-decoration: none; transition: all 0.2s;"
                   onmouseover="this.style.borderColor='#86efac'; this.style.backgroundColor='#f0fdf4';"
                   onmouseout="this.style.borderColor='#e5e7eb'; this.style.backgroundColor='transparent';">
                    <div style="padding: 0.5rem; background: #dcfce7; border-radius: 0.5rem; margin-right: 1rem;">
                        <div style="width: 14px; height: 14px; color: #16a34a;">
                            @svg('heroicon-o-film', ['style' => 'width: 14px; height: 14px;'])
                        </div>
                    </div>
                    <div>
                        <p style="font-weight: 600; color: #111827; margin: 0;">New Project</p>
                        <p style="font-size: 0.75rem; color: #6b7280; margin: 0.125rem 0 0 0;">Add a new project</p>
                    </div>
                </a>

                <a href="{{ route('filament.admin.resources.gallery-items.create') }}" 
                   style="display: flex; align-items: center; padding: 1rem; border: 2px solid #e5e7eb; border-radius: 0.75rem; text-decoration: none; transition: all 0.2s;"
                   onmouseover="this.style.borderColor='#c084fc'; this.style.backgroundColor='#faf5ff';"
                   onmouseout="this.style.borderColor='#e5e7eb'; this.style.backgroundColor='transparent';">
                    <div style="padding: 0.5rem; background: #f3e8ff; border-radius: 0.5rem; margin-right: 1rem;">
                        <div style="width: 14px; height: 14px; color: #9333ea;">
                            @svg('heroicon-o-photo', ['style' => 'width: 14px; height: 14px;'])
                        </div>
                    </div>
                    <div>
                        <p style="font-weight: 600; color: #111827; margin: 0;">Add Gallery Item</p>
                        <p style="font-size: 0.75rem; color: #6b7280; margin: 0.125rem 0 0 0;">Upload media</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            {{-- Recent Blog Posts --}}
            <div class="dashboard-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem;">📝</span>
                        Recent Blog Posts
                    </h3>
                    <a href="{{ route('filament.admin.resources.blog-posts.index') }}" 
                       style="font-size: 0.875rem; font-weight: 500; color: #da3322; text-decoration: none;">
                        View All →
                    </a>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @forelse($this->getRecentPosts() as $post)
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; background: #f9fafb; border-radius: 0.5rem; border: 1px solid transparent; transition: all 0.2s;"
                             onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.borderColor='#e5e7eb';"
                             onmouseout="this.style.backgroundColor='#f9fafb'; this.style.borderColor='transparent';">
                            <div style="flex: 1; min-width: 0;">
                                <p style="font-weight: 500; color: #111827; font-size: 0.875rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ \Illuminate\Support\Str::limit($post->title, 45) }}
                                </p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0.25rem 0 0 0;">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div style="margin-left: 0.75rem; flex-shrink: 0;">
                                @if($post->is_published)
                                    <span style="padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 500; background: #dcfce7; color: #166534; border-radius: 9999px;">
                                        Published
                                    </span>
                                @else
                                    <span style="padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 500; background: #e5e7eb; color: #374151; border-radius: 9999px;">
                                        Draft
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p style="font-size: 0.875rem; color: #6b7280; text-align: center; padding: 1rem;">No blog posts yet.</p>
                    @endforelse
                </div>
            </div>

            {{-- Recent Partner Inquiries --}}
            <div class="dashboard-card">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; display: flex; align-items: center;">
                        <span style="margin-right: 0.5rem;">🤝</span>
                        Recent Partner Inquiries
                    </h3>
                    @if(\Illuminate\Support\Facades\Route::has('filament.admin.resources.partner-inquiries.index'))
                        <a href="{{ route('filament.admin.resources.partner-inquiries.index') }}" 
                           style="font-size: 0.875rem; font-weight: 500; color: #da3322; text-decoration: none;">
                            View All →
                        </a>
                    @endif
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @forelse($this->getRecentInquiries() as $inquiry)
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; background: #f9fafb; border-radius: 0.5rem; border: 1px solid transparent; transition: all 0.2s;"
                             onmouseover="this.style.backgroundColor='#f3f4f6'; this.style.borderColor='#e5e7eb';"
                             onmouseout="this.style.backgroundColor='#f9fafb'; this.style.borderColor='transparent';">
                            <div style="flex: 1; min-width: 0;">
                                <p style="font-weight: 500; color: #111827; font-size: 0.875rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $inquiry->organization_name }}
                                </p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin: 0.25rem 0 0 0;">
                                    {{ $inquiry->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div style="margin-left: 0.75rem; flex-shrink: 0;">
                                <span style="padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 500; background: #dbeafe; color: #1e40af; border-radius: 9999px;">
                                    {{ ucfirst($inquiry->status ?? 'new') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p style="font-size: 0.875rem; color: #6b7280; text-align: center; padding: 1rem;">No inquiries yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Website Information --}}
        <div class="info-section">
            <div style="position: absolute; top: 0; right: 0; width: 128px; height: 128px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; filter: blur(40px); transform: translate(-1rem, -1rem);"></div>
            <div style="position: absolute; bottom: 0; left: 0; width: 96px; height: 96px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; filter: blur(40px); transform: translate(1rem, 1rem);"></div>
            <div style="position: relative; z-index: 10;">
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; display: flex; align-items: center; color: white;">
                    <span style="margin-right: 0.5rem;">🎬</span>
                    About Women in Film
                </h3>
                <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: 1.25rem; line-height: 1.625;">
                    Women in Film is dedicated to empowering women in the film industry through mentorship, 
                    networking, and professional development opportunities. This admin panel allows you to 
                    manage all aspects of the website, from blog posts and projects to partnerships and community engagement.
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                    <a href="/" target="_blank" 
                       style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255, 255, 255, 0.9); color: #da3322; border-radius: 0.5rem; text-decoration: none; font-weight: 500; transition: all 0.2s;"
                       onmouseover="this.style.background='white'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)';"
                       onmouseout="this.style.background='rgba(255, 255, 255, 0.9)'; this.style.boxShadow='none';">
                        <span style="margin-right: 0.5rem;">Visit Website</span>
                        <span style="width: 14px; height: 14px; display: inline-block;">
                            @svg('heroicon-o-arrow-top-right-on-square', ['style' => 'width: 14px; height: 14px;'])
                        </span>
                    </a>
                    <a href="https://wif.piu.ac.ug/" target="_blank" 
                       style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255, 255, 255, 0.9); color: #da3322; border-radius: 0.5rem; text-decoration: none; font-weight: 500; transition: all 0.2s;"
                       onmouseover="this.style.background='white'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)';"
                       onmouseout="this.style.background='rgba(255, 255, 255, 0.9)'; this.style.boxShadow='none';">
                        <span style="margin-right: 0.5rem;">Mentorship Program</span>
                        <span style="width: 14px; height: 14px; display: inline-block;">
                            @svg('heroicon-o-arrow-top-right-on-square', ['style' => 'width: 14px; height: 14px;'])
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>

